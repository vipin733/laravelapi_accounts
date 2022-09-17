<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validation
        $validateUser = Validator::make($request->all(),[
            'username' => 'required|min:6',
            'password' => 'required|min:6'
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status'  => false,
                'message' => __('messages.validation_error'),
                'errors'  => $validateUser->errors()
            ], 422);
        }

        // checking user
        $user = User::where('email', $request->username)->orWhere('username', $request->username)->first();

        if (!$user ) {
            return response()->json([
                'status' => false,
                'message' => __('messages.invalid_credential'),
            ], 422);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.invalid_credential'),
            ], 422);
        }
       
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status'  => true,
            'message' => __('messages.logout_success'),
        ]);
    }
}
