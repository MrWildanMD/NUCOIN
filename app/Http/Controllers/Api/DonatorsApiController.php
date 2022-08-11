<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\DonatorsResource;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Validator;

class DonatorsApiController extends BaseApiController
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('sanctum')->user()) {
            $donators = Donator::all();

            return $this->successResponse(DonatorsResource::collection($donators), 'List of donators retrieved.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
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
    public function store(Request $request, Exception $e)
    {
        if (auth('sanctum')->user()) {
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error.', $validator->errors());
            }

            $donators = Donator::create($input);
            return $this->successResponse(new DonatorsResource($donators), 'Donator added successfully.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth('sanctum')->user()) {
            $donators = Donator::find($id);
            if (is_null($donators)) {
                return $this->errorResponse('Donator not found.');
            }
            return $this->successResponse(new DonatorsResource($donators), 'Donator retrieved successfully.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
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
    public function update(Request $request, Donator $donator)
    {
        if (auth('sanctum')->user()) {
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error.', $validator->errors());
            }

            $donator->name = $input['name'];
            $donator->address = $input['address'];
            $donator->phone = $input['phone'];
            $donator->save();

            return $this->successResponse(new DonatorsResource($donator), 'Donator info updated successfully.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donator $donator)
    {
        if (auth('sanctum')->user()) {
            $donator->delete();

            return $this->successResponse([], 'Donator removed.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }
}
