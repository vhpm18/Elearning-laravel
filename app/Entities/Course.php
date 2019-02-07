<?php

namespace App\Entities;

use App\Entities\Category;
use App\Entities\Goal;
use App\Entities\Level;
use App\Entities\Requirement;
use App\Entities\Review;
use App\Entities\Student;
use App\Entities\Teacher;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Course
 *
 * @property-read \App\Entities\Category $category
 * @property-read \App\Entities\Level $level
 * @property-read \App\Entities\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Course whereUpdatedAt($value)
 */
class Course extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const PENDING   = 2;
    const REJECTED  = 3;

    /**
     * Con load no se puede usar withCount por eso se tiene que
     * definir en el modelo para que eloquent lo pueda cargar
     */
    protected $fillable = [
        'teacher_id', 'category_id', 'level_id', 'name', 'description', 'picture', 'status',
    ];
    protected $withCount = ['students', 'reviews'];

    public static function boot()
    {
        parent::boot();

        //antes de guardar la informacion static::saving()
        static::saving(function ( ? Course $course) {
            if (!\App::runningInConsole()) {
                $course->slug = str_slug($course->name, "-");
                if (request('picture')) {
                    $course->picture = Helper::uploadFile('picture', 'courses');
                }

            }
        });

        //despues de guardar la informacion static::saved()
        static::saved(function ( ? Course $course) {
            if (!\App::runningInConsole()) {
                if (request('requirements')) {
                    foreach (request('requirements') as $key => $requirement_input) {
                        //    dd($requirement_input);
                        if ($requirement_input) {
                            Requirement::updateOrCreate(
                                [
                                    'id' => request('requirement_id' . $key),
                                ],
                                [
                                    'course_id'   => $course->id,
                                    'requirement' => $requirement_input,
                                ]);
                        }
                    }
                }
                if (request('goal')) {
                    foreach (request('goal') as $key => $goal_input) {
                        //    dd($goal_input);
                        if ($goal_input) {
                            Goal::updateOrCreate(
                                [
                                    'id' => request('goal_id' . $key),
                                ],
                                [
                                    'course_id' => $course->id,
                                    'goal'      => $goal_input,
                                ]);
                        }
                    }
                }

            }

        });

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function pathAttachment()
    {
        return "/images/courses/" . $this->picture;
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'name');
    }
    public function level()
    {
        return $this->belongsTo(Level::class)->select('id', 'name');
    }
    public function goal()
    {
        return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class)
            ->select('id', 'course_id', 'user_id', 'rating', 'comment', 'created_at');
    }
    public function requirements()
    {
        return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }

    public function relatedCourses()
    {
        return $this->with('reviews')
            ->whereCategoryId($this->category->id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit(6)
            ->get();
    }

}
