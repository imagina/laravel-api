<?php

namespace Modules\Itranslation\Services;

use Modules\Itranslation\Repositories\TranslationRepository;
use Modules\Itranslation\Models\Translation;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class TranslationService
{
  public function get(string $key, array $replace = [], ?string $locale = null): mixed
  {
    $translation = $this->getFromDatabase($key, $replace, $locale);

    // If no translation from DB, proceed with normal translation process
    if (is_null($translation)) {
      return trans($key, $replace, $locale);
    }

    return $translation;
  }

  private function getFromDatabase(string $key, array $replace, string $locale): mixed
  {
    $translation = app(TranslationRepository::class)->getItem(
      $key,
      (object)['filter' => ['field' => 'key'], 'include' => ['translations']]
    );

    if ($translation && $translation->hasTranslation($locale)) {
      // Get translation from DB
      $phrase = $translation->translate($locale)->value;
      // Replace variables
      if (!empty($replace)) {
        foreach ($replace as $varKey => $val) {
          $phrase = str_replace(':' . $varKey, $val, $phrase);
        }
      }
      return $phrase;
    }
    return null;
  }

  public function allTranslations(string $locale = null): Collection
  {
    $locale = $locale ?? app()->getLocale();
    $dbTranslations = Translation::withTranslation($locale)->get()
      ->mapWithKeys(fn($t) => [$t->key => $t]);

    $fileTranslations = $this->getFileTranslations($locale);
    $merged = collect($fileTranslations)->map(function ($value, $key) use ($dbTranslations, $locale) {
      if ($dbTranslations->has($key)) {
        return $dbTranslations[$key];
      }

      $fake = new Translation([
        'key' => $key,
        'value' => $value,
        'locale' => $locale,
      ]);

      return $fake;
    });

    return $merged->union($dbTranslations);
  }

  /**
   * Get file translations using the logic provided, and format the keys correctly
   */
  private function getFileTranslations(string $locale): array
  {
    $translations = [];
    $finder = new Filesystem();

    $paths = [];
    foreach (glob(base_path('Modules/*/resources/lang')) as $langPath) {
      if ($finder->isDirectory($langPath)) {
        $paths[] = $langPath;
      }
    }

    $files = $this->getTranslationFilenamesFromPaths($paths, $finder);
    foreach ($files as $locale => $files) {
      foreach ($files as $namespace => $file) {
        $trans = $finder->getRequire($file);
        $trans = \Illuminate\Support\Arr::dot($trans);
        foreach ($trans as $key => $value) {
          $translations["{$namespace}.{$key}"] = $value;
        }
      }
    }

    return $translations;
  }

  /**
   * Get all the names of the Translation files from an array of Paths.
   * Returns [ 'translationkeyprefix' => 'filepath' ]
   */
  protected function getTranslationFilenamesFromPaths(array $paths, Filesystem $finder)
  {
    $files = [];
    $locales = getSupportedLocales();

    foreach ($paths as $path) {
      foreach ($locales as $locale => $language) {
        $glob = $finder->glob("{$path}/{$locale}/*.php");

        if ($glob) {
          foreach ($glob as $file) {
            $moduleName = basename(dirname($file, 4));
            $category = str_replace(["$path/", '.php', "{$locale}/"], '', $file);
            $category = str_replace('/', '.', $category);
            $category = "{$moduleName}::{$category}";
            $files[$locale][$category] = $file;
          }
        }
      }
    }
    return $files;
  }
}
