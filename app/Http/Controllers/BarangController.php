<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\M_Barang;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Random;

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
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->back();
    }

    public function update(UpdateBarangRequest $updateBarangRequest, M_Barang $barang)
    {
        try {
            $barang->update($updateBarangRequest->validated());
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function destroy(M_Barang $barang)
    {
        try {
            $barang->delete();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }
}
