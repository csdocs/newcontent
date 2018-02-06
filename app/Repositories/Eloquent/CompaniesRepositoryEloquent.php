<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CompaniesRepository;
use App\Models\Companies;
use App\Validators\CompaniesValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class CompaniesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CompaniesRepositoryEloquent extends BaseRepository implements CompaniesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Companies::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CompaniesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function setConnection($connection)
    {
       $this->model->setTable($connection);

       return $this->model->refresh();
//        $this->model->setTable("holi");
//        $this->model->refresh();
//       echo "<pre>"; var_dump($this->model->getTable()); die("hol");
    }
}
