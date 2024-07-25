<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\M_Customer;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use RealRashid\SweetAlert\Facades\Alert;

class customerController extends Controller
{
    public function getNameAndTelp(Request $request)
    {
        $idCustomer = $request->input('idCustomer');
        $dataCustomer = M_Customer::where('id', $idCustomer)->get(['nama', 'telp']);

        return response()->json($dataCustomer);
    }

    public function index()
    {
        $code = Random::generate(3, 'A-Z0-9');
        $codeCustomer = 'CUS-' . $code;
        $allCustomer = M_Customer::all();
        return view('ui.customer', [
            'all_customer' => $allCustomer,
            'code_customer' => $codeCustomer
        ]);
    }

    public function store(StoreCustomerRequest $storeCustomerRequest)
    {
        try {
            M_Customer::create($storeCustomerRequest->validated());
            Alert::success('Berhasil', 'Menambahkan Customer');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Menambahkan Customer');
        }

        return redirect()->back();
    }

    public function update(UpdateCustomerRequest $updateCustomerRequest, M_Customer $customer)
    {
        try {
            $customer->update($updateCustomerRequest->validated());
            Alert::success('Berhasil', 'Mengupdate data Customer');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Mengupadate data Customer');
        }

        return redirect()->back();
    }

    public function destroy(M_Customer $customer)
    {
        try {
            $customer->delete();
            Alert::success('Berhasil', 'Menghapus Customer');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Menghapus Customer');
        }

        return redirect()->back();
    }
}
