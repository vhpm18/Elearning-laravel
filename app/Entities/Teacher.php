<?php

namespace App\Entities;

use App\Entities\Course;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Teacher
 *
 * @property-read \App\Entities\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $biography
 * @property string|null $website_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Teacher whereWebsiteUrl($value)
 */
class Teacher extends Model
{
    protected $fillable = ['user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
