<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EksemplarController extends Controller
{
    //getData list semua data
    //showData detail 1 data
    //addData tambah data
    //editData edit data
    //hapusData hapus data

    public function getData()
    {
        $eksemplar = Eksemplar::with(['bookstatus','loan','stocktakeitem'])->get(); //nampilin semua kolom nanti FE yg atur

        $eksemplar = Eksemplar::with(['eksemplar' => function ($query) {
            return $query->with(['bookstatus']);
        }])->get();
        return $eksemplar;
    }

    public function showData($id)
    {
        return Eksemplar::with(['bookstatus'])->findOrFail($id);
    }
}
