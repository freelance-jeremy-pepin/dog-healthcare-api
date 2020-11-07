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
 * App\Models\Dog
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $breed
 * @property string $birthday
 * @property string $comments
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|Dog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dog whereUserId($value)
 */
	class Dog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property integer $id
 * @property integer $active_dog_id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $created_at
 * @property string $updated_at
 * @property Dog $dog
 * @property-read \App\Models\Dog|null $activeDog
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User relations($relations)
 * @method static \Illuminate\Database\Eloquent\Builder|User testbis($relations)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveDogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable, \Tymon\JWTAuth\Contracts\JWTSubject {}
}

