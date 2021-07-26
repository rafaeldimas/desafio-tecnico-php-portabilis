<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
            ->where('active', true)
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

    /**
     * @param array $data
     * @return User|Model|Builder
     */
    public function create(array $data): User|Model|Builder
    {
        $role = Role::where('name', Arr::get($data, 'role'))->firstOrFail();
        $password = bcrypt(Arr::get($data, 'password'));

        return $this->user
            ->newQuery()
            ->create(array_merge(
                Arr::only($data, [ 'name', 'email' ]),
                [
                    'role_id' => $role->id,
                    'active' => true,
                    'password' => $password,
                ]
            ));
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}
