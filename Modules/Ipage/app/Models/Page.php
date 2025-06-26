<?php

namespace Modules\Ipage\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ibuilder\Traits\isBuildable;
use Modules\Ifillable\Traits\isFillable;
use Modules\Iqreable\Traits\IsQreable;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Tag\Traits\TaggableTrait;

class Page extends CoreModel
{
    use Translatable;

    // use Translatable, isFillable, IsQreable, isBuildable;

    // use ?? TaggableTrait, NamespacedEntity, MediaRelation, BelongsToTenant

    protected $table = 'ipage__pages';
    public string $transformer = 'Modules\Ipage\Transformers\PageTransformer';
    public string $repository = 'Modules\Ipage\Repositories\PageRepository';
    public array $requestValidation = [
        'create' => 'Modules\Ipage\Http\Requests\CreatePageRequest',
        'update' => 'Modules\Ipage\Http\Requests\UpdatePageRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [
            ['path' => 'Modules\Imedia\Events\CreateMedia']
        ],
        'creating' => [],
        'updated' => [
            ['path' => 'Modules\Imedia\Events\UpdateMedia']
        ],
        'updating' => [],
        'deleting' => [
            ['path' => 'Modules\Imedia\Events\DeleteMedia']
        ],
        'deleted' => []
    ];
    public array $translatedAttributes = [
        'title',
        'slug',
        'status',
        'body',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];
    protected $fillable = [
        'is_home',
        'template',
        'record_type',
        'type',
        'system_name',
        'internal',
        'options',
    ];

    protected $casts = [
        'is_home' => 'boolean',
        'options' => 'json',
    ];

    /**
     * Media Fillable
     */
    public $mediaFillable = [
        'mainimage' => 'single',
        'gallery' => 'multiple',
        'secondaryimage' => 'single',
        'breadcrumbimage' => 'single'
    ];

    /**
     * Relation Media
     * Make the Many To Many Morph
     */
    public function files()
    {
        if (isModuleEnabled('Imedia')) {
            return app(\Modules\Imedia\Relations\FilesRelation::class)->resolve($this);
        }
        return new \Imagina\Icore\Relations\EmptyRelation();
    }

    public function getUrlAttribute($locale = null)
    {

        $currentLocale = $locale ?? locale();
        if (!is_null($locale)) {
            $this->slug = $this->getTranslation($locale)->slug;
        }

        return \LaravelLocalization::localizeUrl('/' . $this->slug, $currentLocale);
    }

    public function setSystemNameAttribute($value)
    {
        $this->attributes['system_name'] = !empty($value) ? $value : \Str::slug($this->title, '-');
    }

    public function getCacheClearableData()
    {
        $baseUrls = [];

        if (!$this->wasRecentlyCreated) {
            $baseUrls[] = $this->url;
        }
        $urls = ['urls' => $baseUrls];

        return $urls;
    }

}
