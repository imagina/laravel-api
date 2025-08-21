<?php

namespace Modules\Islider\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Islider\Models\Slider;
use Modules\Islider\Repositories\SlideRepository;
use Modules\Islider\Repositories\SliderRepository;

class InitialSliderDataSeeder extends Seeder
{
  public function run(): void
  {
    if (Slider::count() === 0) {
      // Define system names for the 2 sliders
      $systemNames = ['slider_home', 'slider_2'];
      $sliderRepository = app(SliderRepository::class);
      $slideRepository = app(SlideRepository::class);

      foreach ($systemNames as $sIndex => $systemName) {
        $sliderNumber = $sIndex + 1;

        $slider = $sliderRepository->create([
          'title' => "Slider $sliderNumber (EN)",
          'system_name' => $systemName,
          'active' => true,
        ]);

        // Create 3 slides per slider
        foreach (range(1, 3) as $i) {
          $slideRepository->create([
            'slider_id' => $slider->id,
            'position' => $i,
            'target' => '_blank',
            'type' => 'image',
            'active' => true,
            'external_image_url' => "https://picsum.photos/seed/slider{$sliderNumber}_{$i}/800/400",
            'options' => ['animation' => 'fade'],
            'en' => [
              'title' => "Slide $i of Slider $sliderNumber (EN)",
              'uri' => "/en/slider{$sliderNumber}/slide{$i}",
              'url' => "https://example.com/en/slider{$sliderNumber}/slide{$i}",
              'custom_html' => "<p>Custom HTML (EN) for slide {$i} of slider {$sliderNumber}</p>",
              'summary' => "Summary (EN) for slide {$i} of slider {$sliderNumber}",
              'code_ads' => "<!-- ad code EN -->",
              'active' => true,
            ],
            'es' => [
              'title' => "Diapositiva $i del Carrusel $sliderNumber (ES)",
              'uri' => "/es/slider{$sliderNumber}/slide{$i}",
              'url' => "https://example.com/es/slider{$sliderNumber}/slide{$i}",
              'custom_html' => "<p>HTML personalizado (ES) para la diapositiva {$i} del carrusel {$sliderNumber}</p>",
              'summary' => "Resumen (ES) de la diapositiva {$i} del carrusel {$sliderNumber}",
              'code_ads' => "<!-- código de anuncio ES -->",
              'active' => true,
            ],
          ]);
        }
      }
    }
  }
}
