<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use App\Models\GeneralManagerOperasional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;




class User extends Controller
{
    public function register()
    {
        $data['title'] = "Register";
        return view('register', $data);
    }

    public function registerstaff()
    {
        $data['title'] = "Register Karyawan";
        return view('registerkaryawan', $data);
    }

    public function registeracc(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:karyawan,email|unique:pelanggan,email|unique:generalmanageroperasional,email',
            'nama' => 'required',
            'nomor_telepon' => 'required|unique:karyawan,nomor_telepon|unique:pelanggan,nomor_telepon|unique:generalmanageroperasional,nomor_telepon',
            'username' => 'required|unique:karyawan,username|unique:pelanggan,username|unique:generalmanageroperasional,username',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'nomor_telepon.required' => 'Nomor Telepon is required',
            'nomor_telepon.unique' => 'Nomor Telepon already exists',
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Passwords do not match',
            'gambar.image' => 'The file must be an image',
            'gambar.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed',
            'gambar.max' => 'The image size should not exceed 2048 KB'
        ]);

        $user = new Pelanggan([
            'email' => $request->email,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $user->gambar = $filename;
        }

        $existing_user = Pelanggan::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($existing_user) {
            if ($existing_user->username == $request->username) {
                return redirect()->back()->withErrors(['username' => 'Username already exists'])->withInput();
            }
            if ($existing_user->email == $request->email) {
                return redirect()->back()->withErrors(['email' => 'Email already exists'])->withInput();
            }
        }

        $user->save();
        return redirect()->route('login')->with('success', 'Data Successfully Registered');
    }
    public function registeraccstaff(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:karyawan,email|unique:pelanggan,email|unique:generalmanageroperasional,email',
            'nama' => 'required',
            'nomor_telepon' => 'required|unique:karyawan,nomor_telepon|unique:pelanggan,nomor_telepon|unique:generalmanageroperasional,nomor_telepon',
            'username' => 'required|unique:karyawan,username|unique:pelanggan,username|unique:generalmanageroperasional,username',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'jabatan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'nomor_telepon.required' => 'Nomor Telepon is required',
            'nomor_telepon.unique' => 'Nomor Telepon already exists',
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Passwords do not match',
            'jabatan.required' => 'Jabatan is required',
            'gambar.image' => 'The file must be an image',
            'gambar.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed',
            'gambar.max' => 'The image size should not exceed 2048 KB'
        ]);

        if ($request->jabatan == 'karyawan') {
            $user = new Karyawan([
                'email' => $request->email,
                'nama' => $request->nama,
                'nomor_telepon' => $request->nomor_telepon,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan,
            ]);
        } elseif ($request->jabatan == 'generalmanageroperasional') {
            $user = new GeneralManagerOperasional([
                'email' => $request->email,
                'nama' => $request->nama,
                'nomor_telepon' => $request->nomor_telepon,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan,
            ]);
        }

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $user->gambar = $filename;
        }

        $user->save();

        return redirect()->route('login')->with('success', 'Data Successfully Registered');
    }
    public function showPasswordForm()
    {
        return view('password_form');
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|password_check',
        ]);

        session(['entered_password' => true]);

        return redirect()->route('register.staff');
    }


    public function login()
    {
        $data['title'] = "Login";
        return view('login', $data);
    }

    public function loginacc(Request $request)
    {
        $request->validate([
            'username' => 'required|username',
            'password' => 'required',
        ]);

        $userTypes = ['Pelanggan', 'Karyawan', 'GeneralManagerOperasional'];
        $user = collect();

        foreach ($userTypes as $userType) {
            $user = $user->merge(app("App\\Models\\{$userType}")->where('username', $request->input('username'))->take(1)->get());
        }

        $user = $user->first();
        if (!$user) {
            return back()->withErrors([
                'username' => 'Username is incorrect',
            ]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors([
                'password' => 'Password is incorrect',
            ]);
        }

        if ($user->status === 'inactive') {
            $user->status = 'active';
            $user->save();
            $request->session()->regenerate();
        }

        switch ($user->jabatan ?? 'pelanggan') {
            case 'karyawan':
                return redirect()->intended('dashboardkaryawan');
            case 'generalmanageroperasional':
                return redirect()->intended('dashboardgeneralmanageroperasional');
            default:
                return redirect('dashboardpelanggan');
        }
    }


    public function logout(Request $request)
    {
        if (Auth::check()) {
            $username = Auth::user()->username;

            $user = app("App\\Models\\Pelanggan")->where('username', $username)->first();

            if ($user) {
                $user->status = 'inactive';
                $user->save();
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return view('login');
    }









    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $randomPassword = Str::random(6);
            $user->password = Hash::make($randomPassword);
            $user->save();

            return redirect()->back()->with('success', 'Your password has been reset to: ' . $randomPassword);
        } else {
            return redirect()->back()->withErrors(['email' => 'Email not found']);
        }
    }

    public function editProfile()
    {
        $data['title'] = "Edit Profile";
        $user = Auth::user();
        $data['user'] = $user;
        return view('edit_profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:userlist,username,' . Auth::user()->id,
            'email' => 'required|unique:userlist,email,' . Auth::user()->id,
            'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|same:password',
            'picture' => 'nullable|image|max:2048',
        ], [
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.same' => 'Passwords do not match',
        ]);

        $existing_user = User::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($existing_user) {
            if ($existing_user->id != Auth::user()->id) {
                if ($existing_user->username == $request->username) {
                    return redirect()->back()->withErrors(['username' => 'Username already exists'])->withInput();
                }
                if ($existing_user->email == $request->email) {
                    return redirect()->back()->withErrors(['email' => 'Email already exists'])->withInput();
                }
            }
        }

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $file_name = $picture->getClientOriginalName();
            $file_path = $picture->move(public_path('images'), $file_name);
            $user->picture = $file_name;
        }

        $user->save();

        return redirect()->route('homepage')->with('success', 'Profile updated successfully');
    }
}
