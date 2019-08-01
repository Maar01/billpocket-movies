<?php

namespace App\Http\Controllers;

use App\Http\apiTraits\ApiResponse;
use App\Http\Requests\UserRegistering;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function register(UserRegistering $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            $this->setHttpResponse('sucess', 200);
        } else {
            $this->setHttpResponse('error', 422);
        }
        return $this->sendResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function login(Request $request)
    {
        $header = array();
        $credentials = $request->only('name', 'email', 'password');
        $token = $this->guard()->attempt($credentials);
        if ($token) {
            $this->setHttpResponse('sucess', 200);
            $header['Authorization'] = $token;
        } else {
            $this->setHttpResponse('error', 401, ['error' => 'login_error']);
        }
        return $this->sendResponse($header);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function logout()
    {
        $this->guard()->logout();
        $this->setHttpResponse('sucess', 200, ['message' => 'Logged out Successfully.']);
        return $this->sendResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function currentUser(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'sucess',
            'data' => $user
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function tokenUpdate()
    {
        $header = array();
        $token = $this->guard()->refresh();
        if ($token) {
            $this->setHttpResponse('sucess', 200);
            $header['Authorization'] = $token;
        } else {
            $this->setHttpResponse('error', 401, ['error' => 'token update error']);
        }
        return $this->sendResponse($header);
    }

    /**
     * @return mixed
     * @version 30/07/2019
     * @author Mario Avila
     */
    private function guard()
    {
        return Auth::guard();
    }
}
