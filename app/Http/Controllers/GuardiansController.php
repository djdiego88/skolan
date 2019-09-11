<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guardian;

class GuardiansController extends Controller
{
    /**
     * Get all the Guardians in the Database
     *
     * @param Request $request
     * @return array Collection Array
     */
    public function all(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return Guardian::with('user:id,first_name,last_name')->get();
    }
}
