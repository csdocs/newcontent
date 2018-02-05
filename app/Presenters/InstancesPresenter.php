<?php

namespace App\Presenters;

use App\Transformers\InstancesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstancesPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstancesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstancesTransformer();
    }
}
