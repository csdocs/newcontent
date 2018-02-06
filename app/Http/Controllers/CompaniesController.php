<?php

namespace App\Http\Controllers;


use App\Contracts\Repositories\InstancesRepository;
use App\Repositories\Eloquent\InstancesRepositoryEloquent;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CompaniesCreateRequest;
use App\Http\Requests\CompaniesUpdateRequest;
use App\Contracts\Repositories\CompaniesRepository;
use App\Validators\CompaniesValidator;

/**
 * Class CompaniesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CompaniesController extends Controller
{
    /**
     * @var CompaniesRepository
     */
    protected $Companies;

    /**
     * @var CompaniesValidator
     */
    protected $validator;


    protected $Instances;

    /**
     * CompaniesController constructor.
     *
     * @param CompaniesRepository $repository
     * @param CompaniesValidator $validator
     * @param
     */
    public function __construct(
        CompaniesRepository $repository,
        CompaniesValidator $validator,
        InstancesRepository $instancesRepository
    )
    {
        $this->Companies = $repository;
        $this->validator  = $validator;
        $this->Instances = $instancesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_GET);

            $instance = $this->Instances->findWhere(["IdInstancia" => $request->input("idInstance")])->first();

            if(is_null($instance))
                return response()->json(["status" => false, "message" => "Instance not found"]);

            $companies = $this->Companies->all();

            return response()->json(['data' => $companies]);
        }
        catch (ValidatorException $e){
            return response()->json(["status" => false, "message" => $e->getMessageBag()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompaniesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CompaniesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $company = $this->Companies->create($request->all());

            $response = [
                'message' => 'Companies created.',
                'data'    => $company->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->Companies->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $company,
            ]);
        }

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->Companies->find($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CompaniesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CompaniesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $company = $this->Companies->update($request->all(), $id);

            $response = [
                'message' => 'Companies updated.',
                'data'    => $company->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->Companies->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Companies deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Companies deleted.');
    }
}
