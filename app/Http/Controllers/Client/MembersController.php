<?php

namespace App\Http\Controllers\client;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/member', 'GET', ['search' => $search]);
        // $response = app()->handle($http);
        // $response = $response->getContent();

        // $member = json_decode($response);
        $member = Member::where('name', 'LIKE', "%$search%")->paginate(5);
        // dd($member);
        return view('petugas/keanggotaan/daftar-anggota', ['members' => $member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas/keanggotaan/create-anggota');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/member/add', 'POST', $request->all(), files: $request->allFiles());

        $response = app()->handle($http);
        // dd($response);
        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/member/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();


        $member = json_decode($response);

        return view('petugas/keanggotaan/edit-anggota', ['members' => $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/member/edit/' . $id, 'POST', $request->except('_method'), files: $request->allFiles());
        $response = app()->handle($http);

        // dd($response);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);
        $deletedMemberIdList = $request->deletedMember;

        if (!$deletedMemberIdList) {
            return redirect()->back();
        }

        foreach ($deletedMemberIdList as $memberId) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/member/destroy/' . $memberId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.member');
    }
}
