<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreasController extends Controller
{
    public function all(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return Area::all();
    }
}
