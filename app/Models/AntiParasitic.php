<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $dog_id
 * @property integer $cared_by_professional_id
 * @property string $date
 * @property string $anti_parasitic_name
 * @property boolean $cared_by_owner
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property Professional $professional
 * @property Dog $dog
 */
class AntiParasitic extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anti_parasitic';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['dog_id', 'cared_by_professional_id', 'date', 'anti_parasitic_name', 'cared_by_owner', 'notes'];

    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['professional', 'dog'];

    /**
     * @return BelongsTo
     */
    public function professional()
    {
        return $this->belongsTo('App\Models\Professional', 'cared_by_professional_id');
    }

    /**
     * @return BelongsTo
     */
    public function dog()
    {
        return $this->belongsTo('App\Models\Dog');
    }
}
