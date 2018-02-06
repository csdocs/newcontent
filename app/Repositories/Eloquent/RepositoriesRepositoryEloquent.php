<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\RepositoriesRepository;
use App\Models\Repositories;
use App\Validators\RepositoriesValidator;

/**
 * Class RepositoriesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class RepositoriesRepositoryEloquent extends BaseRepository implements RepositoriesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Repositories::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RepositoriesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
