<?php

namespace App\Entities;

use App\Entities\Course;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Review
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property int $rating
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Review whereUserId($value)
 */
class Review extends Model
{
    protected $fillable = [
        'course_id', 'user_id', 'rating', 'comment',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
