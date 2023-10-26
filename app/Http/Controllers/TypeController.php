<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $type = Type::all();
        return response()->json($type, 200);
    }
}
