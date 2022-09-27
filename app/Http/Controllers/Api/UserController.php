<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->service->getUsersWithMetaData($request);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'meta' => $data['meta'],
            'data' => $data['data']
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->service->insertRules());

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'fail'
            ], 422);
        }

        $data = $validator->validated();

        $user = $this->service->insertUser($data);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $user = $this->service->getUserById($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = $this->service->getUserById($id);

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'fail'
            ], 404);
        }

        $validator = Validator::make($request->all(), $this->service->updateRules($user));

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'fail'
            ], 422);
        }

        $data = $validator->validated();

        $this->service->updateUser($id, $data);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $user->fresh()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $this->service->deleteUser($id);

        return response()->json([
            'status' => true,
            'message' => 'success'
        ], 200);
    }
}
