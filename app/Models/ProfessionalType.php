<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $internal_label
 * @property string $display_label
 * @property string $created_at
 * @property string $updated_at
 * @property Professional[] $professionals
 */
class ProfessionalType extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professional_type';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['internal_label', 'display_label'];

        /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['professionals'];

    /**
     * @return HasMany
     */
    public function professionals()
    {
        return $this->hasMany('App\Models\Professional');
    }
}
