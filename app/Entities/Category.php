<?php

namespace App\Entities;

use App\Entities\Course;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Category
 *-Yygg0102
 * @property-read \App\Entities\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUpdatedAt($value)
 */
class Category extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
