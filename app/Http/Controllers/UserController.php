<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    public function fetchAdmins()
    {
        // Fetch admin details
        $admin = User::select('id', 'role', 'name')->where('role', 'admin')->get();

        return response()->json($admin);
    }
}
