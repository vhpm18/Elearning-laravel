<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name Nombre del rol de usuario
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Role whereUpdatedAt($value)
 */
class Role extends Model
{
    /**
     * Definimos los tipode de usuario del sistema
     */
    const ADMIN   = 1;
    const TEACHER = 2;
    const STUDENT = 3;

}
