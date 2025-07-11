<?php

namespace Modules\Iuser\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;

use Illuminate\Http\Request;

//Model
use Modules\Iuser\Models\User;
use Modules\Iuser\Repositories\UserRepository;
use Modules\Iuser\Services\UserService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class UserApiController extends CoreApiController
{

    private $userService;

    public function __construct(User $model, UserRepository $modelRepository, UserService $userService)
    {
        parent::__construct($model, $modelRepository);
        $this->userService = $userService;
    }

    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->input('attributes'); //Get data from request

            //Search if user exists
            if (isset($data['email']))
                $user = $this->modelRepository->getItem($data['email'], json_decode(json_encode(["filter" => ["field" => "email"]])));

            //Validation Guest
            if (isset($user) && $user->is_guest) {

                $data->is_guest = 0;
                $response = $this->modelRepository->updateBy($user->id, $data);
            } else {

                //Validate data
                $this->validateWithModelRules($data, 'create');
                //Create user
                $user = $this->modelRepository->create($data);
                //Set response
                $response = [
                    'data' => "User registered successfully"
                ];
            }

            DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            DB::rollback(); //Rollback to Data Base
            [$status, $response] = $this->getErrorResponse($e);
        }

        //Return response
        return response()->json($response, $status ?? Response::HTTP_OK);
    }
}
