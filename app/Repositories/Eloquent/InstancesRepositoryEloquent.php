<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\InstancesRepository;
use App\Models\Instances;
use App\Validators\InstancesValidator;

/**
 * Class InstancesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class InstancesRepositoryEloquent extends BaseRepository implements InstancesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Instances::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstancesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
