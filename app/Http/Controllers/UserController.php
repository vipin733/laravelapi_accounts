<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->search;
        $users = User::latest();
        if ($query ) {
            $users = $users->where(function($q) use($query) {
                $q->where('email','like',"%{$query}%")->orWhere('contact_no','like',"%{$query}%")->orWhere('first_name', 'like', "%{$query}%")->orWhere('last_name', 'like', "%{$query}%");
            });
        }

        $users = $users->where("is_admin", false)->get();
        return UserResource::collection( $users);
    }

    public function show(Request $request)
    {
        $user = $request->user();
        $user->is_details = true;
        return new UserResource($user);
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $validateUser = Validator::make($request->all(),[
                'first_name'   => 'required|regex:/^[\pL\s]+$/u',
                'last_name'    => 'required|regex:/^[\pL\s]+$/u',
                'email'        => ['required', Rule::unique('users', "email")->ignore($user->id),'email:rfc,dns'],
                'contact_no'   => ['required', Rule::unique('users', "contact_no")->ignore($user->id),'digits_between:10,15'],
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status'  => false,
                    'message' => __('messages.validation_error'),
                    'errors'  => $validateUser->errors()
                ], 422);
            }
    
            $userData = [
                "first_name"        => $request->first_name,
                "last_name"         => $request->last_name,
                "email"             => $request->email,
                "contact_no"        => $request->contact_no,
            ];
    
            $user->update($userData);
            $user->is_details = true;
            return new UserResource($user);
        } catch (\Exception $e) {
            Log::error([$e]);
            return response()->json([
                'status'  => false,
                'message' => __('messages.server_error')
            ], 500);
        }
    }
}
