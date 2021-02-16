<?php

namespace App\Http\Controllers\Data\Accounts\Updates;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserNameRequest;

class NameUpdateController extends Controller
{
    public function update(UpdateUserNameRequest $request, User $user){
        $user->update(['name'=>$request->name]);
        return response()->json(['user' => $user]);
    }
}
