<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\InvoiceServices;
use App\Http\Requests\Invoice\StoreInvoiceRequest;

class InvoiceController extends Controller
{
    public function storeInvoice(StoreInvoiceRequest $request)
    {
        $invoice_id = $request->invoice_id;
        if (!$invoice_id) {
            $invoice_id = date('YmdHis');
        }
        $invoice = Invoice::query()->firstOrCreate(['invoice_id'=>$invoice_id]);
        $customer_name = $request->customer_name;
        $customer_address = $request->customer_address;
        $invoice_detail = $request->invoice_detail;
        $amount_before_tax = 0;
        foreach ($invoice_detail as $detail) {
            $detail_amount = $detail['quantity'] * $detail['unit_price'];
            $amount_before_tax+=$detail_amount;
        }
        $vat = InvoiceService::calculateTax($amount_before_tax);
        $total_amount = $amount_before_tax + $vat;
        $invoice->customer_name = $customer_name;
        $invoice->customer_address = $customer_address;
        $invoice->invoice_detail = $invoice_detail;
        $invoice->vat = $vat;
        $invoice->amount_before_tax = $amount_before_tax;
        $invoice->total_amount = $total_amount;
        $invoice->save();
        return response(['status'=>'success','message'=>'Invoice successfully stored'], 200);
    }
    public function listInvoice(Request $request)
    {
        $invoice = Invoice::query();
        if ($search_text = $request->search_text) {
            $invoice->where(function ($query) use ($search_text) {
                $query->where('invoice_detail', 'LIKE', "%{$search_text}%")
                ->orWhere('customer_name', 'LIKE', "%{$search_text}%")
                ->orWhere('invoice_id', $search_text);
            });
        }
        $invoice_count = $invoice->count();
        $invoice_amount = $invoice->sum('total_amount');
        $invoice = $invoice->orderBy('id', 'DESC')->paginate($request->page_size);
        $summary = ['invoice_count'=>$invoice_count,'invoice_amount'=>$invoice_amount];
        return response(['status'=>'success','message'=>'Successful','data'=>$invoice,'summary'=>$summary], 200);
    }
}
