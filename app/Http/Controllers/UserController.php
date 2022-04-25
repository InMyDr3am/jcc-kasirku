<?php

namespace App\Http\Controllers;
//use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade\PDF;
use PDF;
use JSPDF;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;




class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    
    public function create()
    {
        $role_user = RoleUser::all();
        return view('user.create', compact('role_user'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'role_user_id' => 'required',
                'email' => 'required|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required'
            ],
            [
                'name.required' => 'Nama Harus diisi !',
                'role_user_id.required' => 'Jabatan Harus diisi !',
                'email.required' => 'Email Harus diisi !',
                'email.unique' => 'Email Sudah terdaftar !',
                'username.required' => 'Username Harus diisi !',
                'username.unique' => 'Username Sudah terdaftar !',
                'password.required' => 'Password Harus diisi !',
            ]
        );

        $user = new User;
        $user->name = $request->name;
        $user->role_user_id = $request->role_user_id;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->save();

        return redirect('/user')->with('success', 'Data User berhasil ditambah');
    }

    
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role_user = RoleUser::all();

        return view('user.edit', compact('user', 'role_user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'role_user_id' => 'required',
                'username' => 'required',
                'email' => 'required'
            ],
            [
                'name.required' => 'Nama Harus diisi !',
                'role_user_id.required' => 'Jabatan Harus diisi !',
                'username.required' => 'Username Harus diisi !',
                'email.required' => 'Email Harus diisi !',
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->role_user_id = $request->role_user_id;
        $user->username = $request->username;
        $user->email = $request->email;
   
        $user->save();

        return redirect('/user')->with('success', 'Data User Berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('success', 'Data User Berhasil dihapus');
    }

}
