<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\multiselect;

class ImaginaInstall extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'imagina:install';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Bootstrap Imagina packages and modules for dev or prod environments';

  // Available modules
  protected array $config = [];

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    $this->config = config('imagina-install');

    $mode = select(
      label: 'Which environment do you want to install?',
      options: ['dev', 'prod'],
      default: 'dev'
    );

    if ($mode === 'dev') {
      $this->installDev();
    } else {
      $this->installProd();
    }
  }


  protected function installDev(): void
  {
    $this->info('Installing in DEV mode...');

    // Including composer file dev
    $composerFileDev = $this->config['dev_composer_file'];
    if (!file_exists(base_path("$composerFileDev.json"))) {
      if (!file_exists(base_path("$composerFileDev.example"))) {
        $this->warn("$composerFileDev.example not found");
      } else {
        copy(base_path("$composerFileDev.example"), base_path("$composerFileDev.json"));
        $this->info("$composerFileDev.json created");
      }
    }

    // Always install default modules
    foreach ($this->config['default'] as $module) {
      $this->cloneRepo($module['git'], base_path($module['path']));
    }

    // Let user pick optional modules
    $choices = $this->selectModules();

    // If ALL is chosen → override with all module names
    foreach ($this->config['optional'] as $module) {
      if (in_array($module['name'], $choices)) {
        $this->cloneRepo($module['git'], base_path($module['path']));
      }
    }

    // Run update + dump again
    $this->runComposer(['update --no-scripts']);
    $this->runComposer(['dump-autoload']);

    //Finish modules
    $this->finalizeModules();
  }

  protected function installProd(): void
  {
    $this->info('Installing in PROD mode...');

    // Always install default modules
    foreach ($this->config['default'] as $module) {
      $this->requirePackage($module['prodPackage']);
    }

    // Let user pick optional modules
    $choices = $this->selectModules();

    // If ALL is chosen → override with all module names
    foreach ($this->config['optional'] as $module) {
      if (in_array($module['name'], $choices)) {
        $this->requirePackage($module['prodPackage']);
      }
    }

    // Run dump autoload (no need for update)
    $this->runComposer(['dump-autoload']);

    // Finalize modules
    $this->finalizeModules();
  }

  protected function selectModules(): array
  {
    // Let user pick optional modules
    $moduleOptions = array_column($this->config['optional'], 'name');
    $choices = multiselect(
      label: 'Select optional modules to install',
      options: ['ALL', ...$moduleOptions]
    );

    // If ALL is chosen → override with all module names
    if (in_array('ALL', $choices)) $choices = $moduleOptions;

    //response
    return $choices;
  }

  protected function requirePackage(string $prodPackage): void
  {
    $cmd = "composer require $prodPackage --no-scripts";
    passthru($cmd);
  }


  protected function cloneRepo($gitUrl, $destination): void
  {
    if (is_dir($destination)) {
      $this->warn("Skipping, already exists: $destination");
      return;
    }
    $devBranch = $this->config['dev_branch'];
    $this->info("Cloning $gitUrl → [$devBranch] → $destination");
    exec("git clone -b $devBranch $gitUrl $destination");
  }

  protected function runComposer(array $args): void
  {
    $cmd = 'composer ' . implode(' ', $args);
    $this->info("Running: $cmd");
    passthru($cmd);
  }

  protected function finalizeModules(): void
  {
    $this->info('Finalizing all modules...');

    $this->call('config:clear');
    $this->call('module:enable', ['--all' => true]);
    $this->call('module:migrate', ['--all' => true]);
    $this->call('module:seed', ['--all' => true]);
    $this->call('module:publish', ['--all' => true]);

    $this->info('✔ All modules finalized');
  }

}
