<?php

namespace App\Http\Controllers;

use App\Models\InvoicesDetails;
use App\Models\Invoices;
use App\Models\InvoicesAttachments;
use Illuminate\Http\Request;



class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // return "welcome to edit";
        // echo $id;
        $invoices = Invoices::where('id',$id)->first();
        $details  = InvoicesDetails::where('invoice_id',$id)->get();
        $attachments  = InvoicesAttachments::where('invoice_id',$id)->get();

        return view('invoices.invoicesDetails',compact('invoices','details','attachments'));
        // return view('invoices.invoicesDetails', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoicesDetails $invoicesDetails)
    {
        //
    }

    // public function open_file($invoice_number,$file_name)

    // {
    //     $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
    //     return response()->file($files);
    // }
}
