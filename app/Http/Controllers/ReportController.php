<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('reports.report');
        // return "welcome my name is ahmed";
        // $item = Section::find(1) -> get();
        // // $products = Product::all();
        // return view('test', compact('item'));

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
    public function show(string $id)
    {
        // return "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function Search(Request $request){

    //     $rdio = $request->rdio;


    //  // في حالة البحث بنوع الفاتورة

    //     if ($rdio == 1) {


    //  // في حالة عدم تحديد تاريخ
    //         if ($request->type && $request->start_at =='' && $request->end_at =='') {

    //            $invoices = Invoices::select('*')->where('Status','=',$request->type)
    //            ->get();
    //            $type = $request->type;
    //            return view('reports.report',compact('type', 'invoices'));
    //         }

    //         // في حالة تحديد تاريخ استحقاق
    //         else {

    //           $start_at = date($request->start_at);
    //           $end_at = date($request->end_at);
    //           $type = $request->type;

    //           $invoices = Invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
    //           return view('reports.report',compact('type','start_at','end_at', 'invoices'));
    //         //   ->with('invoices');

    //         }



    //     }

    // //====================================================================

    // // في البحث برقم الفاتورة
    //     else {

    //         $invoices = Invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
    //         return view('reports.report')->with($invoices);

    //     }



        // }

}
