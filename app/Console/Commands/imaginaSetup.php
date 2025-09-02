<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Laravel\Passport\ClientRepository;
use function Laravel\Prompts\select;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;
use function Laravel\Prompts\password;

class imaginaSetup extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'imagina:setup';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Init Imagina laravel wrapper';
  protected array $config = [];
  protected string $mode = 'dev';

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    $this->info('=== Initializing Project ===');
    $this->config = config('imagina-setup');
    $this->getMode();
    $this->checkNeededFiles();
    //choose options
    $options = [
      'all' => 'All',
      'app' => 'Setup App',
      'db' => 'Setup Database',
      's3' => 'Setup S3',
      'passport' => 'Setup Passport',
      'modules' => 'Setup Modules',
    ];
    $selectedOptions = multiselect(
      label: 'Select which you want to run:',
      options: $options
    );
    //Process
    if (in_array('all', $selectedOptions)) $selectedOptions = array_keys($options);
    if (in_array('app', $selectedOptions)) $this->setupApp();
    if (in_array('db', $selectedOptions)) $this->setupDB();
    if (in_array('s3', $selectedOptions)) $this->setupS3();
    if (in_array('passport', $selectedOptions)) $this->setupPassport();
    if (in_array('modules', $selectedOptions)) $this->setupModules();

    $this->info('=== Project DONE ===');
  }

  public function checkNeededFiles(): void
  {
    // .env
    if (!File::exists(base_path('.env'))) {
      File::copy(base_path('.env.example'), base_path('.env'));
      $this->info('.env created, please re-run the imagina:setup command');
      exit;

    } else {
      $this->warn('.env Already exist');
    }
  }

  public function getMode(): void
  {
    $this->mode = select(
      label: 'Which environment do you want to install?',
      options: ['dev', 'docker', 'prod'],
      default: 'dev'
    );
  }

  public function setupApp(): void
  {

    $prefix = '[APP]';
    $this->call('key:generate');
    $this->info('APP_KEY Generated');

    $appName = text(label: "$prefix Which is your app Name?", required: true);
    if ($this->mode === 'docker') {
      $appUrl = 'http://nginx';
      $memcachedHost = 'memcached';
    } else {
      //Get APP data
      $appUrl = text(label: "$prefix Which is your app URL?", required: true);
      $memcachedHost = '127.0.0.1';
    }
    // Set up in .env
    $this->updateEnv([
      'APP_NAME' => $appName,
      'APP_URL' => $appUrl,
      'APP_DEBUG' => $this->mode === 'prod' ? 'false' : 'true',
      'APP_ENV' => $this->mode === 'prod' ? 'production' : 'local',
      'MEMCACHED_HOST' => $memcachedHost,
    ]);
  }

  public function setupDB(): void
  {
    if ($this->mode === 'docker') {
      $dbDatabase = 'laravel-api';
      $dbUsername = 'laravel-api';
      $dbPassword = 'laravel-api';
    } else {
      $prefix = '[DB]';
      $dbDatabase = text(label: "$prefix Database Name?", required: true);
      $dbUsername = text(label: "$prefix Database User Name?", required: true);
      $dbPassword = password(label: "$prefix Database Password?", required: true);
    }
    // Set up in .env
    $this->updateEnv([
      'DB_HOST' => $this->mode === 'docker' ? 'mysql' : '127.0.0.1',
      'DB_DATABASE' => $dbDatabase,
      'DB_USERNAME' => $dbUsername,
      'DB_PASSWORD' => $dbPassword,
    ]);
    // Initial Migration
    $this->call('migrate');
  }

  public function setupS3(): void
  {
    $prefix = '[S3]';
    $s3Url = text(label: "$prefix URl");
    $s3AccessKey = text(label: "$prefix Access Key");
    $s3SecretAccessKey = text(label: "$prefix Secret Access Key");
    $s3Bucket = text(label: "$prefix Bucket");
    $s3EndPoint = text(label: "$prefix End Point");
    // Set up in .env
    $this->updateEnv([
      'AWS_URL' => $s3Url,
      'AWS_ACCESS_KEY_ID' => $s3AccessKey,
      'AWS_SECRET_ACCESS_KEY' => $s3SecretAccessKey,
      'AWS_BUCKET' => $s3Bucket,
      'AWS_ENDPOINT' => $s3EndPoint,
    ]);
  }

  public function setupPassport(): void
  {
    $this->info('Config Passport...');
    $this->call('passport:keys');

    $clientRepository = new ClientRepository();
    $client = $clientRepository->createPasswordGrantClient('API', 'users', true);

    // Save it in .env
    $this->updateEnv([
      'PASSPORT_PASSWORD_CLIENT_ID' => $client->getKey(),
      'PASSPORT_PASSWORD_CLIENT_SECRET' => $client->plainSecret,
    ]);
  }

  protected function updateEnv(array $data): void
  {
    $envPath = base_path('.env');
    $env = File::get($envPath);

    foreach ($data as $key => $value) {
      $pattern = "/^$key=.*$/m";
      if (preg_match($pattern, $env)) {
        $env = preg_replace($pattern, "$key=$value", $env);
      } else {
        $env .= "\n$key=$value";
      }
    }

    File::put($envPath, $env);
  }


  protected function setupModules(): void
  {
    $prefix = '[MODULES]';
    $this->info("$prefix Installing Modules");
    $modules = $this->config['default_modules'];
    // Choose the origin to install modules
    $origin = select(label: 'Install Modules using:', options: ['composer', 'git']);
    // The user chooses optional modules
    $moduleOptions = array_column($this->config['optional_modules'], 'name');
    $choices = multiselect(label: "$prefix Select Modules", options: ['ALL', ...$moduleOptions]);
    if (in_array('ALL', $choices)) $choices = $moduleOptions;
    $modules = array_merge($modules, array_filter(
      $this->config['optional_modules'],
      fn($module) => in_array($module['name'], $choices)
    ));
    // Merge composer.local if needed
    if ($origin === 'git') {
      $composerFileDev = $this->config['dev_composer_file'];
      if (!file_exists(base_path("$composerFileDev.json"))) {
        copy(base_path("$composerFileDev.example"), base_path("$composerFileDev.json"));
        $this->info("$composerFileDev.json created");
      }
    }
    // install Modules
    foreach ($modules as $module) {
      if ($origin === 'git') {
        $gitUrl = $module['git'];
        $destination = base_path($module['path']);
        if (is_dir($destination)) continue;
        $devBranch = $this->config['prod_version'];
        $this->info("Cloning $gitUrl → [$devBranch] → $destination");
        passthru("git clone -b $devBranch $gitUrl $destination");
      } else {
        passthru("composer require " . $module['prodPackage'] . " --no-scripts");
      }
      $this->info("$prefix ---------- $module[name] Installed");
    }

    //Post install
    $this->postInstallModules($origin, $modules);
  }

  public function postInstallModules(string $origin, array $modules): void
  {
    // COMPOSER - Run update + dump again
    if ($origin === 'git') passthru('composer update --no-scripts');
    passthru('composer dump-autoload');
    passthru('php artisan config:clear');

    // Migrate all modules
    foreach ($modules as $module) {
      if ($module['type'] == 'module') {
        passthru("php artisan module:enable $module[name]");
        passthru("php artisan module:migrate $module[name]");
      }
    }

    // Run seed and publish
    foreach ($modules as $module) {
      if ($module['type'] == 'module') {
        passthru("php artisan module:seed $module[name]");
        passthru("php artisan module:publish $module[name]");
      }
    }
  }
}
