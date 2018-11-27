<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function all(Request $request)
    {   
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return Role::all();
    }
}
