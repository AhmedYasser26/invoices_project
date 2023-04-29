<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section_data = Section::all();
        return view('sections.sections', compact('section_data'));
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


        // $request -> validate(
        //     [
        //     'section_name' => 'required | Unique:section | max:255',
        //     ],

        //     [
        //         'section_name.required' => 'يرجى إدخال إسم القسم',
        //         'section_name.unique' => 'إسم القسم مسجل مسبقا'
        //     ]
        // );

        // $validatedData = $request -> validate(
        //     [
        //         'section_name' => 'required|unique:sections|max:255',
        //         'description' => 'required',
        //     ],

            // [
            //     'section_name.required' => 'يرجى إدخال إسم القسم',
            //     'section_name.unique' => 'إسم القسم مسجل مسبقا',
            //     'description.required' => 'يرجى إدخال الوصف',
            // ]
        // );

        // start_validation
        // $request -> validate([
        //     'section_name' => 'required|unique:sections|max:255',
        //     // 'description' => 'required',
        // ]);

        // End Validation

        Section::create([
            'section_name' => $request -> section_name,
            'description' => $request -> description,
            'created_by' => (Auth::user() -> name),
        ]);

        // session()-> flash('Add', 'تم اضافة القسم بنجاح ');

        // return redirect('/sections');

        return redirect()->back()->with(['Add' => 'تم إضافه القسم بنجاح ']);

        // return redirect('sections/sections');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request -> id;

        $section = Section::find($id);

        $section -> update([
            'section_name' => $request -> section_name,
            'description' => $request -> description
        ]);

        return redirect() -> back() -> with(['Add' => 'تم تعديل القسم بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request -> id;

        Section::find($id)
        -> delete();

        return redirect() -> back() -> with(['Add' => 'تم حذف القسم بنجاح']);

    }
}
