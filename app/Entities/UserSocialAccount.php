<?php

namespace App\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\UserSocialAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_uid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereProviderUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\UserSocialAccount whereUserId($value)
 */
class UserSocialAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_uid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
