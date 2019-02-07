<?php

namespace App\Entities;

use App\Entities\Course;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Goal
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $course_id
 * @property string $goal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Goal whereUpdatedAt($value)
 */
class Goal extends Model
{
    protected $fillable = ['course_id', 'goal'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
