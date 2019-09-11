<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreasController extends Controller
{
    /**
     * Get all Areas from Database
     *
     * @param Request $request
     * @return array  Collection Array
     */
    public function all(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return Area::all();
    }
}
