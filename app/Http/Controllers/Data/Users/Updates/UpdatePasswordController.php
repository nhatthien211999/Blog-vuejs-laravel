<?php

namespace App\Http\Controllers\Data\Users\Updates;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPasswordRequest;

class UpdatePasswordController extends Controller
{
    function update(UpdateUserPasswordRequest $request, User $user){
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['user' => $user->only('id', 'name', 'email', 'role')]);
    }

    function sendResetLink(User $user){

        // $user->sendPasswordResetNotification(Str::random(60));
        
        return response()->json(['user' => $user]);
    }   
}
