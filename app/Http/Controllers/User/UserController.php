<?php

namespace App\Http\Controllers\User;

use App\Components\Request\DataTransfer;
use App\Exceptions\FailedResultException;
use App\Http\Controllers\Controller;
use App\Http\Validations\User\UserStoreValidate;
use App\Http\Validations\User\UserUpdateValidate;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserStoreService;
use App\Services\User\UserUpdateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * @property UserRepository $userRepository
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $query = $this->userRepository->query();

        return self::response($query->customPaginate());
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws FailedResultException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request, User $user)
    {
        $data = $request->post();

        UserStoreValidate::validate($request);

        DB::beginTransaction();

        try {

            if (!(new UserStoreService($user, new DataTransfer($data)))->run()) {

                DB::commit();

                return self::response($user->refresh());
            }

            throw new FailedResultException();

        } catch (\Throwable $exception) {

            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecordNotFoundException
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return self::response($user);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws FailedResultException
     * @throws \App\Exceptions\RecordNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->getById($id);

        UserUpdateValidate::validate($request);

        DB::beginTransaction();

        try {

            if ((new UserUpdateService($user, new DataTransfer($request->post())))->run()) {

                DB::commit();

                return self::response($user->refresh());
            }

            throw new FailedResultException();

        } catch (\Throwable $exception) {

            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecordNotFoundException
     */
    public function destroy($id)
    {
        $user = $this->userRepository->getById($id);

        $user->delete();

        return self::response([]);
    }
}
