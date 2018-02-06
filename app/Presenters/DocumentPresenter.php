<?php

namespace App\Presenters;

use App\Transformers\DocumentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DocumentPresenter.
 *
 * @package namespace App\Presenters;
 */
class DocumentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DocumentTransformer();
    }
}
