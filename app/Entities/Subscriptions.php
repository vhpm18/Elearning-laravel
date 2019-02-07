<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Subscriptions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_plan
 * @property int $quantity
 * @property string|null $trial_ends_at
 * @property string|null $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Subscriptions whereUserId($value)
 */
class Subscriptions extends Model
{
    //
}
