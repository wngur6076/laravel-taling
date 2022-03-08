<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Article
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property string|null $img_1
 * @property-read mixed $thumb_img_url
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ArticleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereImg1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUserId($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\product
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property string|null $thumb_img_path
 * @property int $price
 * @property int $sale_price
 * @property int $is_hidden
 * @property int $is_sold_out
 * @property int $hit_count
 * @property int $review_count
 * @property float $review_point
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\productFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereHitCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereIsSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereReviewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereReviewPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereThumbImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\product whereUpdatedAt($value)
 */
	class product extends \Eloquent {}
}

