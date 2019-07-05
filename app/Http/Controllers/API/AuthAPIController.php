<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Config;
use App\Repositories\UserRepository;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\VerifyRequest;
use App\Http\Resources\User;
use App\Http\Requests\API\Auth\SecondFactorRequest;
use App\Http\Requests\API\Auth\CompleteProfileRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('auth:api', ['except' => ['login', 'verify', 'refresh']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $r)
    {
        $mobile = $r->get('mobile');
        // first, let's look for existing user
        $user = $this->userRepository->checkMobile($mobile);

        // if user doesn't exist, let's create it
        if (!$user) {
            $user = $this->userRepository->saveUser($mobile);
        }
        $user = $this->userRepository->saveActivationCode($user);

        // $user->notify(new VerifyPhoneNumber($user->user_activation_key));

        return response()->json(['mobile' => $mobile]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(VerifyRequest $r)
    {
        $input = $r->only(['mobile', 'code']);

        $user = $this->userRepository->checkMobile($input['mobile']);
        if ($user and $user->activation_code == $input['code']) {
            if (!$token = auth()->login($user)) {
                abort(401, 'Unauthenticated');
            }
            return $this->respondWithToken($user, $token);
        }
        abort(401, 'Unauthenticated');
    }

    public function completeProfile(CompleteProfileRequest $r)
    {
        $input = $r->only(['first_name', 'last_name']);
        $input['password'] = Hash::make($r->password);
        $user = auth()->user();
        if (!$user) {
            abort(401, 'Unauthenticated');
        }
        $user = $this->userRepository->completeProfile($user, $input);
        auth()->claims(['tfa_ttl' => Carbon::now()->addMinutes(5)])->refresh();
        if (!$token = auth()->login($user)) {
            abort(401, 'Unauthenticated');
        }
        return $this->respondWithToken($user, $token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function secondFactor(SecondFactorRequest $r)
    {
        $password = $r->post('password');
        $user = auth()->user();
        if (Hash::check($password, $user->password)) {
            auth()->claims(['tfa_ttl' => Carbon::now()->addMinutes(5)])->refresh();
            if (!$token = auth()->login($user)) {
                abort(401, 'Unauthenticated');
            }
            return $this->respondWithToken($user, $token);
        }
        abort(401, 'Unauthenticated');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        if ($token = auth()->refresh()) {
            return $this->respondWithToken(auth()->setToken($token)->user(), $token);
        }
        abort(401, 'Unauthenticated');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($user, $token)
    {
        return response()->json([
            'user'         => new User($user),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Config::get('jwt.ttl') * 60
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $session
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithSession($user, $session)
    {
        return response()->json([
            'user'         => new User($user),
            'session' => $session,
            // 'expires_in' => Config::get('jwt.ttl') * 60
        ]);
    }
}
