<?php

namespace App\Entities;

use App\Entities\Course;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Student
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Student whereUserId($value)
 */
class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title'];
    protected $appends  = ['courses_formatted'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email', 'picture');
    }

    public function getCoursesFormattedAttribute()
    {
        return $this->courses->pluck('name')->implode('<br/>');
    }
}
