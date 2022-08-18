<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Set;
use App\Models\Section;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $set = Set::all();
        $section = Section::all();
        return view('admin.class', compact('set','section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
           'class_name' => 'required|max:25|unique:sets,class_name',

        ]);

         $set = new Set;
         $set->class_name = $request->class_name;
         $set->section = implode(',', $request->section);
         $set->save();
         return redirect('/admin/class')->with('success', 'Class Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $class = Set::find($id);
            $class->class_name = $request->input('class_name');
            $class->update();
        return view('admin.class')->with('success', 'Class Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $delete = Set::where('id', $id)->delete();
        $set = Set::find($id);
        $set->delete();
        return response('Class Deleted Successfully.', 200);
    }
}