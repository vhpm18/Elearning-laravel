<?php

namespace App\Entities;

use App\Entities\Course;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Requirement
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $course_id
 * @property string $requirement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Requirement whereUpdatedAt($value)
 */
class Requirement extends Model
{
    protected $fillable = ['course_id', 'requirement'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
