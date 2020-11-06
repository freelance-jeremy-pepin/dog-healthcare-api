<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $breed
 * @property string $birthday
 * @property string $comments
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class Dog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dog';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'breed',
        'birthday',
        'comments'
    ];

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'active_dog_id');
    }
}
