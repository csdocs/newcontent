<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Instances;

/**
 * Class InstancesTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstancesTransformer extends TransformerAbstract
{
    /**
     * Transform the Instances entity.
     *
     * @param \App\Models\Instances $model
     *
     * @return array
     */
    public function transform(Instances $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
