<?php

namespace App\Http\Controllers\Api\User\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRegisterRequest;
use App\Models\BarrierTokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    private function checkLogin($login) {
        return User::where('name', $login)->first();
    }
    private function checkEmail($email) {
        return User::where('email', $email)->first();
    }
    public function action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:4|max:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        if($this->checkLogin($request->login) OR $this->checkEmail($request->email)) {
            return response()->json(['status' => false, 'message' => 'Login or email already exist']);
        }

        $user = new User();
        $user->name = $request->login;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();

        $barrier = new BarrierTokens();
        $barrier->user_id = $user->id;
        $barrier->token = $user->id . Str::random(64);
        $barrier->reg_ip = $request->ip();
        $barrier->last_login_ip = $request->ip();
        $barrier->save();


        return response()->json(['status' => true, 'token' => $barrier->token]);
    }
}
