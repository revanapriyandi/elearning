<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 'admin') {
            return redirect()->route('dashboard')->with('warning', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        return view('Pages.Users.Index', [
            'users' => User::all()
        ]);
    }

    public function edit($id)
    {
        if (auth()->user()->id != $id && auth()->user()->role != 'admin') {
            return redirect()->route('dashboard')->with('warning', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        return view('Pages.Users.Edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => ['required', 'string', 'unique:users,username, ' . $id, 'max:255'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'unique:users,email, ' . $id, 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password != null ? bcrypt($request->password) : $user->password,
            'role' => $request->role ?? $user->role,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        if (auth()->user()->id != $id && auth()->user()->role != 'admin') {
            return redirect()->route('dashboard')->with('warning', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
