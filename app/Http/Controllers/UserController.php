<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getData()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function showData()
    {
        //info admin siapa yg login
        $user = auth()->user();
        // $user = User::all()->findOrFail($id);
        return response()->json($user, 200);
    }

    public function addData(Request $request)
    { //jika dibutuhkan tambah data

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255', 'unique:user,username',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'required|max:255|email', 'unique:user,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create(['name' => $request->name, 'username' => $request->username, 'password' => Hash::make($request->password), 'email' => $request->email]);
        return response()
            ->json(['message' => 'Admin baru berhasil ditambahkan!', 'data' => $user]);
    }

    public function editData(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255', 'unique:user.id',
            'new_password' => 'nullable|min:8',
            'password_confirm' => 'nullable|same:new_password',
            'email' => 'nullable|max:255|email', 'unique:user.id',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $storeImage = $image->storeAs('public/images', $fileName);
            $imagePath = asset(str_replace("public", "storage", $storeImage));
            $data['image'] = $imagePath;

            // http://127.0.0.1:8000/storage/images/1618531176_1618531176_eksemplar.jpg
            // public/images/1618531176_1618531176_eksemplar.jpg

            if ($user->image && Storage::exists(str_replace(asset('storage'), 'public', $user->image))) {
                Storage::delete(str_replace(asset('storage'), 'public', $user->image));
            }
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($data);

        //cuma bisa rubah password aja, jika ubah info lain error
        if ($request->has('new_password') && $request->new_password) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
        }

        // $user->update([
        //     'password' => Hash::make($request->new_password),
        // ]);

        return response()
            ->json(['message' => 'Data Admin berhasil diubah!', 'data' => $user]);
    }

    public function login(Request $request)
    {
        return view('dashboard.login');
    }
    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd($credentials);
        //if !email verify kkrim email utk verif
        //else lanjut dibawha
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('beranda');
            // return redirect()->intended('beranda');
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Nama Pengguna atau Kata Sandi Salah. AKSES DITOLAK');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return response()->json(['message'=>'Anda berhasil Logout!']);
        return redirect('login');
    }

    public function showForgotPasswordForm(Request $request)
    {
        return view('dashboard.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;

        return view('dashboard.reset', ['token' => $token, 'email' => $email]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );


        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
