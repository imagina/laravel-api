<?php

namespace Modules\Imedia\Services;


use Validator;
use Illuminate\Support\Facades\Storage;

use Modules\Imedia\Repositories\FileRepository;
use Modules\Imedia\Support\FileHelper;

class FolderService
{

    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param File
     */
    public function store($data)
    {

        //Get Disk
        $disk = $data['disk'] ?? 's3';

        //Validations
        $this->checkValidations($data);

        //Save Folder
        $savedFile = $this->saveData($data, $disk);

        //TODO - Duda, no veo que se este creando una carpeta en un disco

        return $savedFile;
    }


    /**
     * Validations
     */
    private function checkValidations($data)
    {
        $request = new \Modules\Imedia\Http\Requests\CreateFolderRequest($data);
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        //if get errors, throw errors
        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()), 400);
        }
    }

    /**
     * Save Data in Database
     */
    private function saveData($data, $disk)
    {

        //Fix data to Save
        $dataToSave = [
            'filename' => $data['name'],
            'path' => $this->getPath($data),
            'folder_id' => $data['parent_id'] ?? 0,
            'is_folder' => true,
            'disk' => $disk
        ];

        //Save File
        return $this->fileRepository->create($dataToSave);
    }

    /**
     *
     */
    private function getPath(array $data): string
    {
        if (array_key_exists('parent_id', $data)) {
            $parent = $this->findFolder($data['parent_id']);
            if ($parent !== null) {
                dd("GET Relative Path");
                //TODO
                //return $parent->path->getRelativeUrl() . '/' . \Str::slug($data['name']);
            }
        }

        return config('imedia.files-path') . \Str::slug($data['name']);
    }

    /**
     *
     */
    public function findFolder($folderId)
    {

        //return $this->model->where('is_folder', 1)->where('id', $folderId)->first();

        $params = json_decode(json_encode([
            "filter" => [
                "is_folder" => 1
            ]
        ]));

        return $this->fileRepository->getItem($folderId, $params);
    }
}
