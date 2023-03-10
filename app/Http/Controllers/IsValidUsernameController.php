<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class IsValidUsernameController extends Controller
{
    protected function validateUsername(Request $request)
    {
        return response()->json([
            "isValid" => User::where(
                'username',
                $request->get('username')
            )->exists()
        ]);
    }
}
