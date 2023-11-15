<?php

namespace App\Http\Controllers\Client;

use App\Models\Member;
use App\Models\Loan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoansController extends Controller
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
        $http = $http->create(url('api') . '/loan', 'GET', ['search' => $search]);

        $loans = Loan::whereHas("member", function ($b) use ($search) {
            $b->where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%");
        })

            ->orWhereHas("eksemplar", function ($b) use ($search) {
                $b->where('item_code', 'LIKE', "%$search%");
            })

            ->orWhereHas("eksemplar.biblio", function ($b) use ($search) {
                $b->where('title', 'LIKE', "%$search%");
            })

            ->orWhere('loan_status', 'LIKE', "%$search%")->paginate(10);

        return view('petugas/sirkulasi/sejarah-peminjaman', ['loans' => $loans]);
    }

    public function overdue(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(url('api') . '/loan', 'GET', ['search' => $search]);

        $loan = Loan::with(['eksemplar', 'member', 'eksemplar.biblio']);
        $loan = $loan->whereHas("member", function ($b) use ($search) {
            $b->where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%");
        })

            ->orWhereHas("eksemplar", function ($b) use ($search) {
                $b->where('item_code', 'LIKE', "%$search%");
            })

            ->orWhereHas("eksemplar.biblio", function ($b) use ($search) {
                $b->where('title', 'LIKE', "%$search%");
            })

            ->orWhere('loan_status', 'LIKE', "%$search%");

        $loans = $loan->get();
        $loans = $loans->filter(function ($loan) {
            return $loan->return_status == '2';
        })->paginate(10);


        return view('petugas/sirkulasi/daftar-keterlambatan', ['loans' => $loans]);
    }
    public function copyout(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(url('api') . '/loan', 'GET', ['search' => $search]);

        $loan = Loan::with(['eksemplar', 'member', 'eksemplar.biblio']);
        $loan = $loan->whereHas("member", function ($b) use ($search) {
            $b->where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%");
        })

            ->orWhereHas("eksemplar", function ($b) use ($search) {
                $b->where('item_code', 'LIKE', "%$search%");
            })

            ->orWhereHas("eksemplar.biblio", function ($b) use ($search) {
                $b->where('title', 'LIKE', "%$search%");
            })

            ->orWhere('loan_status', 'LIKE', "%$search%");

        $loans = $loan->get();
        $loans = $loans->filter(function ($loan) {
            return $loan->return_status == '0';
        })->paginate(10);

        return view('petugas/bibliografi/eksemplar-keluar', ['loans' => $loans]);
    }

    public function fastreturnIndex(Request $request)
    {
        return view('petugas/sirkulasi/pengembalian-kilat');
    }
    public function fastreturn(Request $request, $id)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(url('api') . '/loan/pengembaliankilat' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.loan-fastreturn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(url('api') . '/member', 'GET', ['search' => $search]);
        // $response = app()->handle($http);
        // $response = $response->getContent();

        // $member = json_decode($response);
        $member = Member::where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%")->orWhere('institution', 'LIKE', "%$search%")->paginate(10);
        // dd($member);
        return view('petugas/sirkulasi/mulai-transaksi', ['members' => $member]);
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
    public function loan($id)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/member/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $http = new Request();
        $http = $http->create(url('api') . '/loan/', 'GET', ['member' => $id]);
        $loan = app()->handle($http);
        $loan = $loan->getContent();

        $member = json_decode($response);
        $loan = json_decode($loan);

        return view('petugas/sirkulasi/peminjaman', ['members' => $member, 'loans' => $loan]);
    }

    public function pinjam(Request $request, $member)
    {

        $http = new Request();
        $http = $http->create(url('api') . '/loan/add/' . $member, 'POST', $request->all());
        $res = app()->handle($http);
        $res = $res->getContent();


        return redirect()->route('client.loan', ['id' => $member]);
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
        $http = $http->create(url('api') . '/member/edit/' . $id, 'POST', $request->except('_method'), files: $request->allFiles());
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
    public function destroy(Request $request, $loan)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/loan/destroy/' . $loan, 'DELETE');
        $response = app()->handle($http);
        $response = $response->getContent();

        return redirect()->back();
    }

    public function selesai_transaksi($member)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/loan/transaksi/' . $member, 'POST');
        $res = app()->handle($http);
        $res = $res->getContent();

        return redirect()->route('client.loan-start');
    }

    public function pengembalian(Request $request, $loan)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/loan/pengembalian/' . $loan, 'POST');
        $res = app()->handle($http);
        $res = $res->getContent();

        return redirect()->back();
    }

    public function perpanjang(Request $request, $loan)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/loan/perpanjang/' . $loan, 'POST');
        $res = app()->handle($http);
        $res = $res->getContent();

        return redirect()->back();
    }
}
