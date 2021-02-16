<?php

namespace App\Http\Controllers\Data\Accounts\Updates;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserEmailRequest;

class EmailUpdateController extends Controller
{
    public function update(UpdateUserEmailRequest $request, User $user){
        $user->update(['email' => $request->email]);
        return response()->json(['user'=>$user]);
    }
}
