<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $internal_label
 * @property string $display_label
 * @property string $format
 * @property string $created_at
 * @property string $updated_at
 * @property Reminder[] $reminders
 */
class TimeInterval extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'time_interval';

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
        'internal_label',
        'display_label',
        'format'
    ];

    /**
     * Relations du modèle.
     *
     * @var string[]
     */
    protected $relations = ['user'];

    /**
     * @return HasMany
     */
    public function reminders()
    {
        return $this->hasMany('App\Models\Reminder');
    }
}
