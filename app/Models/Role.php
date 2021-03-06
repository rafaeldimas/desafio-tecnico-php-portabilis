<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Role
 * @package App\Models
 *
 * @property string $name
 * @property boolean $active
 *
 * @property User $user
 * @property Permission[]|Collection $permissions
 *
 * @mixin Builder
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
