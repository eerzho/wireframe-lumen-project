<?php

namespace App\Http\Controllers\User;

use App\Components\Request\DataTransfer;
use App\Exceptions\FailedResultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserStoreService;
use App\Services\User\UserUpdateService;
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

        return $this->response($query->customPaginate());
    }

    /**
     * @param UserCreateRequest $request
     * @param User              $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws FailedResultException
     * @throws \Throwable
     */
    public function store(UserCreateRequest $request, User $user)
    {
        DB::beginTransaction();

        try {

            if ((new UserStoreService($user, new DataTransfer($request->post())))->run()) {

                DB::commit();

                return $this->response($user->refresh());
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

        return $this->response($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param                   $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws FailedResultException
     * @throws \App\Exceptions\RecordNotFoundException
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->getById($id);

        DB::beginTransaction();

        try {

            if ((new UserUpdateService($user, new DataTransfer($request->post())))->run()) {

                DB::commit();

                return $this->response($user->refresh());
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

        return $this->response([]);
    }
}
