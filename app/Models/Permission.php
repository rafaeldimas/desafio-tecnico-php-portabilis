<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Permission
 * @package App\Models
 *
 * @property string $label
 * @property string $name
 *
 * @property Role[]|Collection $roles
 *
 * @mixin Builder
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'name',
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
