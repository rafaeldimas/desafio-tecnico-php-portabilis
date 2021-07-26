<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserStoreRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $userStoreRequest
     * @return Builder|Model|User
     * @throws AuthorizationException
     */
    public function store(UserStoreRequest $userStoreRequest): Model|Builder|User
    {
        $this->authorize('user_store');

        $data = $userStoreRequest->validated();

        return $this->userRepository->create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $userUpdateRequest
     * @param User $user
     * @return User
     * @throws AuthorizationException
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user): User
    {
        $this->authorize('user_update');

        $data = $userUpdateRequest->validated();

        return $this->userRepository->update($user, $data);
    }
}
