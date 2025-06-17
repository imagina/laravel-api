<?php

namespace Modules\Imedia\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class File extends CoreModel
{
    use Translatable;

    protected $table = 'imedia__files';
    public string $transformer = 'Modules\Imedia\Transformers\FileTransformer';
    public string $repository = 'Modules\Imedia\Repositories\FileRepository';
    public array $requestValidation = [
        'create' => 'Modules\Imedia\Http\Requests\CreateFileRequest',
        'update' => 'Modules\Imedia\Http\Requests\UpdateFileRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [],
        'creating' => [],
        'updated' => [],
        'updating' => [],
        'deleting' => [
            ['path' => 'Modules\Imedia\Events\FileIsDeleting']
        ],
        'deleted' => []
    ];
    public array $translatedAttributes = [
        'alt',
        'keywords'
    ];
    protected $fillable = [
        'is_folder',
        'filename',
        'path',
        'extension',
        'mimetype',
        'filesize',
        'folder_id',
        'has_watermark',
        'has_thumbnails',
        'disk'
    ];

    /**
     * ATTRIBUTES
     */
    protected function path(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {

                //$disk = is_null($this->disk) ? setting('media::filesystem', null, config('asgard.media.config.filesystem')) : $this->disk;
                //return new MediaPath($value, $disk, $this->organization_id, $this);

                return $value . "guayaba";
            }
        );
    }

    /**
     * METHODS
     */
    public function isImage()
    {
        //TODO - EL Setting no funca
        //$imageExtensions = (array)json_decode(setting('media::allowedImageTypes', null, config("imedia.allowedImageTypes")));
        $imageExtensions = (array)json_decode(config("imedia.allowedImageTypes"));

        // Case external disk
        if (isset($this->disk) && !in_array($this->disk, array_keys(config("filesystems.disks")))) {
            $dataExternalImg = app("Modules\Media\Services\\" . ucfirst($this->disk) . "Service")->getDataFromUrl($this->path);
            return in_array($dataExternalImg['extension'], $imageExtensions);
        } else {
            return in_array(pathinfo($this->path, PATHINFO_EXTENSION), $imageExtensions);
        }
    }
}
