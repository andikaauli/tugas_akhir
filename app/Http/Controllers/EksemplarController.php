<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use Illuminate\Http\Request;

class EksemplarController extends Controller
{
    //getData list semua data
    //showData detail 1 data
    //addData tambah data
    //editData edit data
    //hapusData hapus data

    // public function getData()
    // {
    //     // $eksemplar = Eksemplar::with(['biblio', 'bookstatus'])->first();

    //     // return $eksemplar->biblio->title; //Ambil tilte biblio suatu eksemplar

    //     // return [
    //         //     $eksemplar['biblio']['title'],
    //         //     $eksemplar['biblio']['year'],
    //         // ];

    //         $eksemplar = Eksemplar::with(['biblio' => function($query){
    //             return $query->select(['id','title', 'publisher']);
    //         }, 'bookstatus'])->get(['id','inventory_code', 'item_code', 'book_status_id', 'biblio_id']);

    //         return $eksemplar;

    // }

    // public function showData($id)
    // {
    //     // return Eksemplar::findOrFail($id);

    //     // return Eksemplar::with(['bookstatus'])->findOrFail($id);
    //     return Eksemplar::with(['bookstatus'])->where('id', '=', $id)->firstOrFail();


    //     // $eksemplar = Eksemplar::find($id);
    //     // if(!$eksemplar) return "Tidak Ada";
    //     // return $eksemplar;
    // }
}
