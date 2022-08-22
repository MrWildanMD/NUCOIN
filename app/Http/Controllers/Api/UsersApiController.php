<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\UsersResource;
use App\Models\User;

class UsersApiController extends BaseApiController
{
    public function index()
    {
        if (auth('sanctum')->user()) {
            $users = User::all();

            return $this->successResponse(UsersResource::collection($users), 'List of users retrieved.');
        }
        return $this->errorResponse('Unauthorized', [], 401);
    }
}
