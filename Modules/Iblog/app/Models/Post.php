<?php

namespace Modules\Iblog\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;
use Modules\Iuser\Models\User;

class Post extends CoreModel
{
    use Translatable;

    protected $table = 'iblog__posts';
    public string $transformer = 'Modules\Iblog\Transformers\PostTransformer';
    public string $repository = 'Modules\Iblog\Repositories\PostRepository';
    public array $requestValidation = [
        'create' => 'Modules\Iblog\Http\Requests\CreatePostRequest',
        'update' => 'Modules\Iblog\Http\Requests\UpdatePostRequest',
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
        'description',
        'slug',
        'summary',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'translatable_options',
        'status',
    ];
    protected $fillable = [
        'options',
        'category_id',
        'user_id',
        'featured',
        'sort_order',
        'external_id',
        'created_at',
        'date_available'
    ];

    protected $casts = [
        'options' => 'json'
    ];

    /**
     * Media Fillable
     */
    public $mediaFillable = [
        'mainimage' => 'single',
        'secondaryimage' => 'single',
        'gallery' => 'multiple',
        'breadcrumbimage' => 'single',
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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'iblog__post__category');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function url($locale = null)
    {
        return Attribute::get(function () {
            if (empty($this->slug)) {
                $post = $this->getTranslation(\LaravelLocalization::getDefaultLocale());
                $this->slug = $post->slug ?? "";
            }

            $currentLocale = $locale ?? locale();
            if (!is_null($locale)) {
                $this->slug = $this->getTranslation($currentLocale)->slug;
                $this->category = $this->category->getTranslation($currentLocale);
            }

            if (empty($this->slug)) return "";

            $currentDomain = !empty($this->organization_id) ? tenant()->domain ?? tenancy()->find($this->organization_id)->domain :
                parse_url(config('app.url'), PHP_URL_HOST);

            if (config("app.url") != $currentDomain) {
                $savedDomain = config("app.url");
                config(["app.url" => "https://" . $currentDomain]);
            }

            if (isset($this->options->urlCoder) && !empty($this->options->urlCoder) && $this->options->urlCoder == "onlyPost") {

                $url = \LaravelLocalization::localizeUrl('/' . $this->slug, $currentLocale);

            } else {
                if (empty($this->category->slug)) $url = "";
                else $url = \LaravelLocalization::localizeUrl('/' . $this->category->slug . '/' . $this->slug, $currentLocale);
            }

            if (isset($savedDomain) && !empty($savedDomain)) config(["app.url" => $savedDomain]);

            return $url;
        });
    }

    public function getCacheClearableData()
    {
        $baseUrls = [config("app.url"), $this->category->url];

        $categoryUrls = $this->categories->pluck('url')->toArray();
        if (!$this->wasRecentlyCreated && $this->status == 2) {
            $baseUrls[] = $this->url;
        }
        $urls = ['urls' => array_unique(array_merge($baseUrls, $categoryUrls))];

        return $urls;
    }

}
