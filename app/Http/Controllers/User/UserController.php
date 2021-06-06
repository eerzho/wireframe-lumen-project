<?php

namespace App\Http\Controllers\User;

use App\Components\Request\DataTransfer;
use App\Exceptions\FailedResultException;
use App\Http\Controllers\Controller;
use App\Http\Validations\User\UserStoreValidate;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
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
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return DB::table('users')->get();
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

        UserStoreValidate::validate($data);

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
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return self::response($user);
    }
}
