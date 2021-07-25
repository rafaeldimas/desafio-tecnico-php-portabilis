<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * @return Factory|View|Application
     * @throws Exception
     */
    public function users(): Factory|View|Application
    {
        $this->authorize('user_index');

        $users = cache()->remember('dashboard-users', now()->addHour(), function () {
            return User::with('role:id,name')->get();
        });

        return view('dashboard.users', compact('users'));
    }
}
