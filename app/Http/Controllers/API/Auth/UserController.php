<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService $service
     */
    private UserService $service;

    /**
     * Constructor
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Get Current Login user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function userDetails(Request $request): JsonResponse
    {
        $user = $this->service->findOrFail(auth('sanctum')->id(), ['activePosCheckIn']);
        return $this->returnSuccessJsonResponse(data: new UserResource($user));
    }
}
