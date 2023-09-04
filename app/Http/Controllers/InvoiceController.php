<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    function InvoicePage():View {
        return view('pages.dashboard.invoice-page');

    }

    function SalePage():View {
        return view('pages.dashboard.sale-page');

    }

    function InvoiceCreate(Request $request) {
        DB::beginTransaction();

        try {

        $user_id=$request->header('id');
        $total=$request->input('total');
        $discount=$request->input('discount');
        $vat=$request->input('vat');
        $payable=$request->input('payable');

        $customer_id=$request->input('customer_id');

        $invoice= Invoice::create([
            'total'=>$total,
            'discount'=>$discount,
            'vat'=>$vat,
            'payable'=>$payable,
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,
        ]);


       $invoiceID=$invoice->id;

       $products= $request->input('products');

       foreach ($products as $EachProduct) {
        Log::info('Inserting product:', ['product_data' => $EachProduct]);
            InvoiceProduct::create([
                'invoice_id' => $invoiceID,
                'user_id'=>$user_id,
                'product_id' => $EachProduct['product_id'],
                'qty' =>  $EachProduct['qty'],
                'sale_price'=>  $EachProduct['sale_price'],
            ]);
        }

       
       DB::commit();

       return 1;

        }
        catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    function InvoiceSelect(Request $request) {
        $user_id= $request->header('id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }

    function InvoiceDetails(Request $request) {
        $user_id = $request->header('id');
        $customer_details = Customer::where('user_id', $user_id)->where('id', $request->input('cus_id'))->get();
        $invoiceTotal = Invoice::where('user_id', $user_id)->where('id', $request->input('inv_id'))->get();
        $invoiceProduct = InvoiceProduct::where('user_id', $user_id)->where('id', $request->input('inv_id'))->get();

        return array(
            'customer'=>$customer_details,
            'invoice'=>$invoiceTotal,
            'product'=>$invoiceProduct,
        );
    }

    function InvoiceDelete(Request $request) {
        DB::beginTransaction();
        try {
            $user_id = $request->header('id');
            InvoiceProduct::where('invoice_id', $request->input('inv_id'))
            ->where('user_id', $user_id)
            ->delete();
            Invoice::where('id', $request->input('inv_id'))->delete();
            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}
