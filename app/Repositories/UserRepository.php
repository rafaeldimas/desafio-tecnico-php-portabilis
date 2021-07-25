<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class UserRepository
{
    public function __construct(
        private User $user
    ) {}

    /**
     * @param array $search
     * @return Collection|array
     */
    public function dashboardSearch(array $search): Collection|array
    {
        return $this->user
            ->newQuery()
            ->when(Arr::get($search, 'name'), function (Builder $builder, $name) {
                return $builder->where('name', 'like', "%{$name}%");
            })
            ->when(Arr::get($search, 'email'), function (Builder $builder, $email) {
                return $builder->where('email', 'like', "%{$email}%");
            })
            ->when(Arr::get($search, 'role'), function (Builder $builder, $role) {
                return $builder->whereHas('role', function (Builder $builder) use ($role) {
                    return $builder->where('name', 'like', "%{$role}%");
                });
            })
            ->when(Arr::get($search, 'order'), function (Builder $builder, $order) {
                $arr = explode('-', $order, '2');

                if (count($arr) !== 2) {
                    return $builder;
                }

                [ $column, $direction ] = $arr;

                return $builder->orderBy($column, $direction);
            })
            ->with('role:id,name')
            ->get();
    }
}
