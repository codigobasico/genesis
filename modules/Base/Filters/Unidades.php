<?php

namespace Modules\Base\Filters;

use EloquentFilter\ModelFilter;

class Unidades extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relatedModel => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function search($query)
    {
        $model = $this->where('codum', 'LIKE', '%' . $query . '%');

        $or_fields = ['unidad', 'dimension'];
        foreach ($or_fields as $or_field) {
            $model->orWhere($or_field, 'LIKE', '%' . $query . '%');
        }

        return $model;
    }

    
}
