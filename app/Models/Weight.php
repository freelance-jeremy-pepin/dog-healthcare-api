<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $dog_id
 * @property string $date
 * @property float $weight
 * @property string $created_at
 * @property string $updated_at
 * @property Dog $dog
 */
class Weight extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weight';

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
        'dog_id',
        'date',
        'weight'
    ];

    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['dog'];

    /**
     * @return BelongsTo
     */
    public function dog()
    {
        return $this->belongsTo('App\Models\Dog');
    }
}
