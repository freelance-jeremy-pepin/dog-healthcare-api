<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

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
class Dog extends BaseModel
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
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = [
        'user',
        'weights'
    ];

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function weights()
    {
        return $this->hasMany('App\Models\Weight', 'dog_id', 'id');
    }
}
