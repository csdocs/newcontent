<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Repositories;

/**
 * Class RepositoriesTransformer.
 *
 * @package namespace App\Transformers;
 */
class RepositoriesTransformer extends TransformerAbstract
{
    /**
     * Transform the Repositories entity.
     *
     * @param \App\Models\Repositories $model
     *
     * @return array
     */
    public function transform(Repositories $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
