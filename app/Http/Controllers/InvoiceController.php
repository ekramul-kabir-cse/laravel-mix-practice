<?php

namespace App\Http\Controllers;


use App\Models\Dependent;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        $user = Dependent::findOrFail($id);
        $data = [
            'id' => $id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'image' => $user->image,
            'address' => $user->address,
            'dob' => $user->dob,
        ];
        $pdf = PDF::loadView('invoice.invoice_design', $data);
        if (request('download')) {
            return $pdf->download('invoice.pdf');
        }
        return view('invoice.invoice_design', $data);
    }
}
