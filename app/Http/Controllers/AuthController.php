<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiUnauthorizedException;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponser;
    public function signup(SignupRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $this->successResponse($user->toArray(), null, Response::HTTP_CREATED);
    }

    public function signin(SigninRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (! Auth::attempt($data))
            throw new ApiUnauthorizedException();

        return $this->successResponse([
            'access_token' => Auth::user()->createToken('access_token')->plainTextToken,
        ]);
    }

    public function signout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->successResponse();
    }
}
