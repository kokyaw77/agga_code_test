<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    protected $service;

    public function __construct(CustomerService $service)
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
        $data = $this->service->getCustomersWithMetaData($request);

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

        $zone = $this->service->insertCustomer($data);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $zone
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
        $city = $this->service->getCustomerById($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $city,
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
        $customer = $this->service->getCustomerById($id);

        if(!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'fail'
            ], 404);
        }

        $validator = Validator::make($request->all(), $this->service->updateRules($customer));

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'fail'
            ], 422);
        }

        $data = $validator->validated();

        $this->service->updateCustomer($id, $data);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $customer->fresh()
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
        $this->service->deleteCustomer($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
        ], 200);
    }
}
