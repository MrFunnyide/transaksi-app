<?php

namespace App\Http\Controllers;

use App\Models\T_Sales;
use App\Models\T_Sales_Det;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class transactionController extends Controller
{
    public function store(Request $request)
    {
        // table t_sales
        $kode_sales = $request->input('kode_transaksi');
        $tgl = $request->input('tgl');
        $cust_id = $request->input('id_customer');
        $sub_total = $request->input('sub_total');
        $diskon = $request->input('diskon');
        $ongkir = $request->input('ongkir');
        $total_bayar = $request->input('total_bayar');

        // insert t_sales
        $t_sales = T_Sales::create([
            'kode' => $kode_sales,
            'tgl' => $tgl,
            'cust_id'  => $cust_id,
            'subtotal' => $sub_total,
            'diskon' => $diskon,
            'ongkir' => $ongkir,
            'total_bayar' => $total_bayar,
        ]);

        // table t_sales_det
        // $sales_id; // di dapat waktu setelah insert table di atas, langsung ambil
        $barang_id = $request->input('id_barang');
        $harga_bandrol = $request->input('harga_bandrol');
        $qty = $request->input('qty');
        $diskon_pct = $request->input('diskon_pct');
        $diskon_nilai = $request->input('diskon_nilai');
        $harga_diskon = $request->input('harga_diskon');
        $total = $request->input('total');

        foreach ($barang_id as $index => $id_barang) {
            // insert t_sales_det
            $data = [
                'sales_id' => $t_sales->id,
                'barang_id' => $id_barang,
                'harga_bandrol' => $harga_bandrol[$index],
                'qty' => $qty[$index],
                'diskon_pct' => $diskon_pct[$index],
                'diskon_nilai' => $diskon_nilai[$index],
                'harga_diskon' => $harga_diskon[$index],
                'total' => $total[$index]
            ];

            // save to database
            T_Sales_Det::create($data);
        }
        $request->session()->forget('carts');
        Alert::success('Berhasil', 'Menambahkan Transaksi');

        return to_route('dashboard');
    }
}
