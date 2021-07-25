<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Models
 *
 * @property string $label
 * @property string $name
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
}
