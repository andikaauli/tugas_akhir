<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TypeController extends Controller
{
    public function getData()
    {
        $type = Type::all();
        return response()->json($type, 200);
    }

}
