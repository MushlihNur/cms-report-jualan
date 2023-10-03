<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        $urutan = $request->input('urutan') ?? 'asc';

        $users = User::orderBy('name', $urutan);

        if ($search) {
            $users->where('name', 'ilike', '%' . $search . '%');
        }

        if ($role) {
            $users->where('role', $role);
        }

        $users = $users->get();

        return view("pages.dashboard.user.index", compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $validatedData['password'] = bcrypt('password');

        User::create($validatedData);

        return redirect('/admin/dashboard/users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'email'],
        ]);
        // dd($validatedData);

        User::where('id', $request['id'])->update($validatedData);

        return redirect('/admin/dashboard/users')->with('success', 'Data pengguna berhasil diubah');
    }

    public function destroy(Request $request)
    {
        // dd($request['id']);
        Sales::where('user_id', $request['id'])->delete();

        User::destroy($request['id']);

        return redirect('/admin/dashboard/users')->with('success', 'Data pengguna berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
