<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\SearchUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * @param SearchUserRequest $searchUserRequest
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function users(SearchUserRequest $searchUserRequest): Factory|View|Application
    {
        $this->authorize('user_index');

        $search = $searchUserRequest->validated();

        $users = cache()->remember('dashboard-users', now()->addHour(), function () use ($search) {
            return $this->userRepository->dashboardSearch($search);
        });

        return view('dashboard.users', compact('users'));
    }
}
