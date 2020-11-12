<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id
 * @property integer $active_dog_id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $created_at
 * @property string $updated_at
 * @property Dog $dog
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active_dog_id',
        'email',
        'firstname',
        'lastname'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = [
        'activeDog',
        'dogs'
    ];

    /**
     * @return BelongsTo
     */
    public function activeDog()
    {
        return $this->belongsTo('App\Models\Dog', 'active_dog_id');
    }

    /**
     * @return HasMany
     */
    public function dogs()
    {
        return $this->hasMany('App\Models\Dog', 'user_id', 'id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
