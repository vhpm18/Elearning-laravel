<?php

namespace App\Entities;

use App\Entities\Course;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Level
 *
 * @property-read \App\Entities\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Level whereUpdatedAt($value)
 */
class Level extends Model
{
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
