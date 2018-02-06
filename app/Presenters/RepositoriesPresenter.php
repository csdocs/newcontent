<?php

namespace App\Presenters;

use App\Transformers\RepositoriesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RepositoriesPresenter.
 *
 * @package namespace App\Presenters;
 */
class RepositoriesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RepositoriesTransformer();
    }
}
