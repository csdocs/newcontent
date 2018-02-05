<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstancesCreateRequest;
use App\Http\Requests\InstancesUpdateRequest;
use App\Contracts\Repositories\InstancesRepository;
use App\Validators\InstancesValidator;

/**
 * Class InstancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstancesController extends Controller
{
    /**
     * @var InstancesRepository
     */
    protected $repository;

    /**
     * @var InstancesValidator
     */
    protected $validator;

    /**
     * InstancesController constructor.
     *
     * @param InstancesRepository $repository
     * @param InstancesValidator $validator
     */
    public function __construct(InstancesRepository $repository, InstancesValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $instances = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instances,
            ]);
        }

        return view('instances.index', compact('instances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstancesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstancesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $instance = $this->repository->create($request->all());

            $response = [
                'message' => 'Instances created.',
                'data'    => $instance->toArray(),
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
        $instance = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instance,
            ]);
        }

        return view('instances.show', compact('instance'));
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
        $instance = $this->repository->find($id);

        return view('instances.edit', compact('instance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstancesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstancesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $instance = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Instances updated.',
                'data'    => $instance->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Instances deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Instances deleted.');
    }
}
