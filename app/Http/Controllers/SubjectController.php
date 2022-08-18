<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'subject_name' => 'max:50|required|unique:subjects,subject_name',
            'subject_code' => 'max:50|required|unique:subjects,subject_code',
        ]);
        $subjects = new Subject;
        $subjects->subject_name = $request->subject_name;
        $subjects->subject_type = $request->subject_type;
        $subjects->subject_code = $request->subject_code;
        $subjects->save();
        return redirect('/admin/subject')->with('message', "Subject Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $subjects = Subject::find($id);
        $subjects->subject_name = $request->subject_name;
        $subjects->subject_type = $request->subject_type;
        $subjects->subject_code = $request->subject_code;
        $subjects->update();
        return redirect('/admin/subject')->with('message', "Subject Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subjects = Subject::find($id);
        $subjects->delete();
        return response('Subject Deleted Successfully.', 200);
    }
}