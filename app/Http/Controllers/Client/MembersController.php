<?php

namespace App\Http\Controllers\Client;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
		$http = $http->create(url('api') . '/member', 'GET', ['search' => $search]);
		// $response = app()->handle($http);
		// $response = $response->getContent();

		// $member = json_decode($response);
		$member = Member::where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%")->paginate(10);
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
		$http = $http->create(url('api') . '/member/add', 'POST', $request->all(), files: $request->allFiles());
		$response = app()->handle($http);

        // dd($response);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.member')->with('success', 'Anggota berhasil ditambahkan!');
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
		$http = $http->create(url('api') . '/member/' . decrypt($id));
		// $http = $http->create(url('api') . '/member/' . $id);
		$response = app()->handle($http);
		$response = $response->getContent();
        // dd($response);

		$member = json_decode($response);
        if($member == null){
            abort(404, 'Not Found');
        }
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
        // dd($id);
		$http = new Request();
		$http = $http->create(url('api') . '/member/edit/' . decrypt($id), 'POST', $request->except('_method'), files: $request->allFiles());
		$response = app()->handle($http);

		// dd($response);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.member')->with('success', 'Anggota berhasil diperbaharui!');
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
			$http = $http->create(url('api') . '/member/destroy/' . $memberId, 'DELETE');
			$response = app()->handle($http);
		}

		// return redirect()->route('client.member')->with('destroy', 'Anggota berhasil dihapus!');
        $member = Member::find($memberId);
        if ($member) {
            $loan = Loan::where('member_id', $memberId)->first();

            if ($loan && $loan->member_id == $member->id) {
                return redirect()->route('client.member')->with('destroy', 'Member tidak dapat dihapus');
            }
        }
        // dd($member);
        return redirect()->route('client.member')->with('destroy', 'Member berhasil dihapus!');
	}
}
