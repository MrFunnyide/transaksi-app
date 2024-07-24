<?php

namespace App\Http\Controllers;

use App\Models\M_Barang;
use App\Models\M_Customer;
use App\Models\T_Sales;
use App\Models\T_Sales_Det;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class salesController extends Controller
{
    public function index(Request $request)
    {
        $dataCartList = $request->session()->get('carts');

        $codeTransaction = Random::generate(6, 'A-Z0-9');
        $cekCode = T_Sales::where('kode', $codeTransaction)->get();
        if (!empty($cekCode)) {
            $codeTransaction = Random::generate(6, 'A-Z0-9');
        }
        $subTotal = 0;
        if ($dataCartList) {
            foreach ($dataCartList as $cartList) {
                $total = ($cartList->harga_barang - ($cartList->diskon_barang * $cartList->harga_barang) / 100) * $cartList->qty_barang;
                $subTotal += $total;
            }
        }
        $dataBarang = M_Barang::select('kode', 'nama')->get();
        $listCustomer = M_Customer::select('kode', 'nama', 'id')->get();
        return view('ui.add-transaksi', [
            'listCart' => $dataCartList,
            'kode_barang' => $dataBarang,
            'list_customer' => $listCustomer,
            'sub_total' => $subTotal,
            'code_transaction' => $codeTransaction
        ]);
    }

    public function getNameAndPrice(Request $request)
    {
        $kodeBarang = $request->input('kodeBarang');

        $dataBarangTerpilih = M_Barang::where('kode', $kodeBarang)->get(['nama', 'harga']);

        return response()->json($dataBarangTerpilih);
    }

    public function addCart(Request $request)
    {
        $cartData = $request->session()->get('carts', []);
        $kodeBarang = $request['kode-barang'];
        $idBarang = M_Barang::where('kode', $kodeBarang)->first();

        $newCartItem = (object) [
            'kode_barang' => $request['kode-barang'],
            'nama_barang' => $request['nama-barang'],
            'id_barang' => $idBarang->id,
            'harga_barang' => $request['harga-barang'],
            'qty_barang' => $request['qty-barang'],
            'diskon_barang' => $request['diskon-barang']
        ];

        $cartData[] = $newCartItem;

        // save to session
        $request->session()->put('carts', $cartData);

        return to_route('page-add-transaksi');
    }

    public function removeItemCart(Request $request)
    {
        $indexRemove = $request->input('index');

        // Ambil data 'carts' dari session
        $dataCartList = $request->session()->get('carts', []);

        // cek data index valid
        if (isset($dataCartList[$indexRemove])) {
            // hapus element
            unset($dataCartList[$indexRemove]);

            // reset array key
            $dataCartList = array_values($dataCartList);

            // simpan kembali
            $request->session()->put('carts', $dataCartList);
        }

        return redirect()->back();
    }

    public function updateItemCart(Request $request)
    {
        $indexUpdate = $request->input('index');

        // dd($request->all());

        $newData = $request->only(['kode-barang', 'nama-barang', 'id-barang', 'harga-barang', 'qty-barang', 'diskon-barang']);

        // ambil data cart sebelum nya
        $dataCartList = $request->session()->get('carts', []);

        // cek apakah ada data dengan index tersebut
        if (isset($dataCartList[$indexUpdate])) {
            // hapus element
            unset($dataCartList[$indexUpdate]);
            // add array baru
            $newCartItem = (object) [
                'kode_barang' => $request['kode-barang'],
                'nama_barang' => $request['nama-barang'],
                'id_barang' => $request['id-barang'],
                'harga_barang' => $request['harga-barang'],
                'qty_barang' => $request['qty-barang'],
                'diskon_barang' => $request['diskon-barang']
            ];

            $dataCartList[] = $newCartItem;

            // simpan kembali array
            $request->session()->put('carts', $dataCartList);
        }

        return redirect()->back();
    }

    public function allTransaction()
    {
        $allTransaction = T_Sales::with(['t_sales_det', 'm_customer'])->get();
        // dd($allTransaction);
        return view('ui.app', [
            'all_transaction' => $allTransaction
        ]);
    }
}
