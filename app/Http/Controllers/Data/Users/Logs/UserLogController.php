<?php

namespace App\Http\Controllers\Data\Users\Logs;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser')->only('index');
    }

    public function index(User $user)
    {
        return response()->json(['results' => UserLog::byUser($user->id)->latest()->paginate(20)]);
    }
}
