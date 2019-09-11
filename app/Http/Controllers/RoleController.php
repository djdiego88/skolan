<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Get all the Roles in the Database
     *
     * @param Request $request
     * @return array Collection Array
     */
    public function all(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return Role::all();
    }
}
