<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeRelations(Builder $query, array $relations)
    {
        foreach ($relations as $relation) {
            if (in_array($relation, $this->relations, true)) {
                $query->with($relations);
            }
        }
    }
}
