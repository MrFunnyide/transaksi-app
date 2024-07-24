<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\M_Customer;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Random;

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
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->back();
    }

    public function update(UpdateCustomerRequest $updateCustomerRequest, M_Customer $customer)
    {
        try {
            $customer->update($updateCustomerRequest->validated());
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->back();
    }

    public function destroy(M_Customer $customer)
    {
        try {
            $customer->delete();
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->back();
    }
}
