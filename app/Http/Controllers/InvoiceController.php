<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('account_id', session()->get('accountLogin'));
        return view('user.invoice', compact('invoices'));
    }
}
