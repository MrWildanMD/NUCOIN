<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseApiController;

class AuthApiController extends BaseApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation Error.', $validator->errors(), 522);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $user->assignRole('guest');
        $success['token'] = $user->createToken(str()->random(40))->plainTextToken;
        $success['name'] = $user->name;

        return $this->successResponse($success, 'User registered successfully.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $success['token'] = $user->createToken(str()->random(40))->plainTextToken;
            $success['name'] = $user->name;

            return $this->successResponse($success, 'User logged in successfully.');
        } else {
            return $this->errorResponse('Unauthorized', ['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return $this->successResponse([], 'User logged out.');
    }
}
