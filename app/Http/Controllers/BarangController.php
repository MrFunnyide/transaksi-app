<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\M_Barang;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        $code = Random::generate(4, 'A-Z0-9');
        $codeBarang = 'BRG-' . $code;
        $allBarang = M_Barang::all();
        return view('ui.barang', [
            'all_barang' => $allBarang,
            'code_barang' => $codeBarang
        ]);
    }

    public function store(StoreBarangRequest $storeBarangRequest)
    {
        try {
            M_Barang::create($storeBarangRequest->validated());
            Alert::success('Berhasil', 'Menambah Barang');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Menambah Barang');
        }

        return redirect()->back();
    }

    public function update(UpdateBarangRequest $updateBarangRequest, M_Barang $barang)
    {
        try {
            $barang->update($updateBarangRequest->validated());
            Alert::success('Berhasil', 'Mengupdate data Barang');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Mengupadate data Barang');
        }
        return redirect()->back();
    }

    public function destroy(M_Barang $barang)
    {
        try {
            $barang->delete();
            Alert::success('Berhasil', 'Menghapus Barang');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Menghapus Barang');
        }
        return redirect()->back();
    }
}
