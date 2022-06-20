<?php

namespace App\Http\Controllers\Pages;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $payment = Payment::find($request->id);
        return view ('pages.invoice.index', compact('payment'));
    }
}
