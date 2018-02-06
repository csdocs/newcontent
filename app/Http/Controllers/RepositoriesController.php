<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RepositoriesCreateRequest;
use App\Http\Requests\RepositoriesUpdateRequest;
use App\Contracts\Repositories\RepositoriesRepository;
use App\Validators\RepositoriesValidator;

/**
 * Class RepositoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class RepositoriesController extends Controller
{
    /**
     * @var RepositoriesRepository
     */
    protected $repository;

    /**
     * @var RepositoriesValidator
     */
    protected $validator;

    /**
     * RepositoriesController constructor.
     *
     * @param RepositoriesRepository $repository
     * @param RepositoriesValidator $validator
     */
    public function __construct(RepositoriesRepository $repository, RepositoriesValidator $validator)
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
        $repositories = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $repositories,
            ]);
        }

        return view('repositories.index', compact('repositories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RepositoriesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RepositoriesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $repository = $this->repository->create($request->all());

            $response = [
                'message' => 'Repositories created.',
                'data'    => $repository->toArray(),
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
        $repository = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $repository,
            ]);
        }

        return view('repositories.show', compact('repository'));
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
        $repository = $this->repository->find($id);

        return view('repositories.edit', compact('repository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RepositoriesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RepositoriesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $repository = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Repositories updated.',
                'data'    => $repository->toArray(),
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
                'message' => 'Repositories deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Repositories deleted.');
    }
}
