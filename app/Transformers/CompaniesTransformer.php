<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Companies;

/**
 * Class CompaniesTransformer.
 *
 * @package namespace App\Transformers;
 */
class CompaniesTransformer extends TransformerAbstract
{
    /**
     * Transform the Companies entity.
     *
     * @param \App\Models\Companies $model
     *
     * @return array
     */
    public function transform(Companies $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
