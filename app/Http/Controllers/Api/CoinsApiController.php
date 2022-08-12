<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoinsResource;
use App\Models\Coins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\Api\BaseApiController;

class CoinsApiController extends BaseApiController
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
            $coins = Coins::all();
            return $this->successResponse(CoinsResource::collection($coins), 'List of coins record retrieved.');
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
    public function store(Request $request)
    {
        if (auth('sanctum')->user()) {
            $input = $request->all();

            $validator = Validator::make($input, [
                'amount' => 'required',
                'coin_date' => 'required',
                'proof' => 'required',
                'user_id' => 'required',
                'donator_id' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error.', $validator->errors());
            }

            if ($validator->validated()) {
                $image = $request->file('proof');

                $imageName = time() . "." . $image->extension();

                $image->move(public_path('images'), $imageName);

                $input['proof'] = $imageName;

                $coins = Coins::create($input);
                return $this->successResponse(new CoinsResource($coins), 'Coins record added successfully.');
            }
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
            $coins = Coins::find($id);

            if (is_null($coins)) {
                return $this->errorResponse('Donator not found.');
            }

            return $this->successResponse(new CoinsResource($coins), 'Coins record retrieved successfully.');
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
    public function update(Request $request, Coins $coins)
    {
        if (auth('sanctum')->user()) {

            $image = $coins->proof;
            if (file_exists('images/' . $image)) {
                unlink('images/' . $image);
            }
            $input = $request->all();

            $validator = Validator::make($input, [
                'amount' => 'required',
                'coin_date' => 'required',
                'proof' => ['required', File::image()->min(512)->max(2048)],
                'user_id' => 'exists:users,id',
                'donator_id' => 'exists:donators,id',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error.', $validator->errors());
            }

            if ($validator->validated()) {
                $image = $request->file('proof');

                $imageName = time() . "." . $image->extension();

                $image->move(public_path('images'), $imageName);

                $input['proof'] = $imageName;

                $coins->amount = $input['amount'];
                $coins->coin_date = $input['coin_date'];
                $coins->proof = $input['proof'];
                $coins->user_id = $input['user_id'];
                $coins->donator_id = $input['donator_id'];
                $coins->save();

                return $this->successResponse(new CoinsResource($coins), 'Coins record updated successfully.');
            }
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coins $coins)
    {
        if (auth('sanctum')->user()) {
            $image = $coins->proof;
            unlink('images/' . $image);
            $coins->delete();

            return $this->successResponse([], 'Coins record removed.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }
}
