<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class IsValidEmailController extends Controller
{
    protected function validateEmail(Request $request)
    {
        return response()->json([
            "isValid" => User::where(
                'email',
                $request->get('email')
            )->exists()
        ]);
    }
}
