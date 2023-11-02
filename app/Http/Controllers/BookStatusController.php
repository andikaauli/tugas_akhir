<?php

namespace App\Http\Controllers;

use App\Models\BookStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookStatusController extends Controller
{
    public function getData()
    {
        $bookstatus = BookStatus::all();
        return response()->json($bookstatus, 200);
    }
}
