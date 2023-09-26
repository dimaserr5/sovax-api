<?php

namespace App\Http\Controllers\Api\User\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function action(Request $request)
    {
        if(!$request->post('login')) return response()->json(['status' => false, 'message' => 'Please enter a login']);
        if(!$request->post('email')) return response()->json(['status' => false, 'message' => 'Please enter a email address']);
        if(!$request->post('password')) return response()->json(['status' => false, 'message' => 'Please enter a password']);
    }
}
