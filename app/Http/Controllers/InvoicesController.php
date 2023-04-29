<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoices;
use App\Models\Product;
use App\Models\Section;
use App\Models\invoicesDetails;
use App\Models\invoicesAttachments;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\addInvoice;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $invoices = Invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('invoices.addInvoices', compact('sections', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return 'welcome to store page';
        // return $request;
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->Product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;

        invoicesDetails::create([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->Product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);


        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoicesAttachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }


        $user = User::get();
        $invoices = invoices::latest()->first();
        // Notification::send($user, new \App\Notifications\Add_invoice_new($invoices));



        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));

        return redirect()->back()->with(['Add' => 'تم إضافة الفاتورة بنجاح ']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoices = Invoices::where('id', $id)->first();
        return view('invoices.updateStatus', compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // return 'welcome to invoices details';
        // return $id;

        $invoices = Invoices::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.invoicesEdit', compact('sections', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function Status_Update(Request $request, Invoices $invoices)
    {
        $invoices = Invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_commission' => $request->Amount_commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();


        // return redirect() -> back() -> with(['Add' => 'تم تعديل الفاتورة']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }


    public function getproducts($id)
    {
        $products = DB::table("products")
            ->where("section_id", $id)
            ->pluck("product_name", "id");
        return json_encode($products);
    }


    public function updateStatus($id, Request $request){

        $invoices = invoices::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            InvoicesDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            InvoicesDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        session()->flash('updateStatus');
        return redirect('/invoices');
    }

    // public function Invoice_Paid()
    // {
    //     $invoices = Invoices::where('Value_Status', 1)->get();
    //     return view('invoices.invoices_paid',compact('invoices'));
    // }
}



