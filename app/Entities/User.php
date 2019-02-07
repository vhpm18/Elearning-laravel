<?php

namespace App\Entities;

use App\Entities\Role;
use App\Entities\Student;
use App\Entities\Teacher;
use App\Entities\UserSocialAccount;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

/**
 * App\Entities\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string|null $last_name
 * @property string $slug
 * @property string $email
 * @property string|null $password
 * @property string|null $picture
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string $trial_ends_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pathAttachment()
    {
        return "/images/users/" . $this->picture;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ( ? User $user) {
            if (!\App::runningInConsole()) {
                $user->slug = str_slug($user->name . " " . $user->last_name, '-');
            }
        });
    }

    public static function navigations()
    {
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class)->select('id', 'user_id', 'title');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function socialAccount()
    {
        return $this->hasOne(UserSocialAccount::class);
    }

}
