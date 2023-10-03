<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Models\Sales;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenis = $request->input('jenis');
        $urutan = $request->input('urutan') ?? 'asc';

        // $sales = Sales::with('user')->orderBy('name', $urutan);
        $sales = Sales::select(['sales.*', 'users.name as user_name'])
                    ->join('users', 'sales.user_id', '=', 'users.id')
                    ->orderBy('users.name', $urutan);

        if ($search) {
            $sales->where('name', 'ilike', '%' . $search . '%')->orWhere('barang', 'like', '%' . $search . '%');
        }

        if ($jenis) {
            $sales->where('jenis', $jenis);
        }

        $sales = $sales->get();

        return view("pages.dashboard.sales.index", compact('sales'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'barang' => ['required'],
            'harga' => ['required'],
            'jenis' => ['required'],
        ]);

        Sales::create($validatedData);

        return redirect('/admin/dashboard/sales')->with('success', 'Penjualan berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            // 'user_id' => ['required'],
            'barang' => ['required'],
            'harga' => ['required'],
            'jenis' => ['required'],
        ]);


        Sales::where('id', $request['id'])->update($validatedData);

        return redirect('/admin/dashboard/sales')->with('success', 'Penjualan berhasil diubah');
    }

    public function destroy(Request $request)
    {
        // dd($request['id']);
        Sales::destroy($request['id']);

        return redirect('/admin/dashboard/sales')->with('success', 'Data penjualan berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }
}
