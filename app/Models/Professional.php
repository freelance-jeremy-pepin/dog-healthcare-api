<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $professional_type_id
 * @property integer $user_id
 * @property string $name
 * @property string $phone_number
 * @property string $mobile_number
 * @property string $address
 * @property string $city
 * @property string $zip_code
 * @property string $email
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property ProfessionalType $professionalType
 * @property User $user
 * @property AntiParasitic[] $antiParasitics
 * @property Deworming[] $dewormings
 */
class Professional extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professional';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'professional_type_id',
        'user_id',
        'name',
        'phone_number',
        'mobile_number',
        'address',
        'city',
        'zip_code',
        'email',
        'notes'
    ];

    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['professionalType', 'antiParasitics', 'dewormings'];

    /**
     * @return BelongsTo
     */
    public function professionalType()
    {
        return $this->belongsTo('App\Models\ProfessionalType');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function antiParasitics()
    {
        return $this->hasMany('App\Models\AntiParasitic', 'cared_by_professional_id');
    }

    /**
     * @return HasMany
     */
    public function dewormings()
    {
        return $this->hasMany('App\Models\Deworming', 'cared_by_professional_id');
    }
}
