<?php

namespace App\Presenters;

use App\Transformers\CompaniesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CompaniesPresenter.
 *
 * @package namespace App\Presenters;
 */
class CompaniesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CompaniesTransformer();
    }
}
