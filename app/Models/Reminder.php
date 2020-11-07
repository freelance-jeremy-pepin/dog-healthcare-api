<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $time_interval_id
 * @property integer $dog_id
 * @property int $number_time_interval
 * @property string $table_name
 * @property string $next_reminder
 * @property string $created_at
 * @property string $updated_at
 * @property Dog $dog
 * @property TimeInterval $timeInterval
 */
class Reminder extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reminder';

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
        'time_interval_id',
        'dog_id',
        'number_time_interval',
        'table_name',
        'next_reminder'
    ];


    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['user'];

    /**
     * @return BelongsTo
     */
    public function dog()
    {
        return $this->belongsTo('App\Models\Dog');
    }

    /**
     * @return BelongsTo
     */
    public function timeInterval()
    {
        return $this->belongsTo('App\Models\TimeInterval');
    }
}
