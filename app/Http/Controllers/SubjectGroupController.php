<?php

namespace App\Http\Controllers;

use App\Models\SubjectGroup;
use App\Models\Set;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectGroups = SubjectGroup::all();
        $sets = Set::all();
        $sections = Section::all();
        $subjects = Subject::all();
        return view('admin.subject-group', compact('subjectGroups','sets','sections','subjects'));
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
            'name' => 'required|max:100',
            // 'class' => 'required|max:50',
        ]);

        $subjectGroups = new SubjectGroup;
        $subjectGroups->name = $request->name;
        $subjectGroups->class = $request->class;
        $subjectGroups->section = implode(',', $request->section);
        $subjectGroups->subject = implode(',', $request->subject);
        $subjectGroups->desc = $request->desc;
        $subjectGroups->save();
        return redirect('/admin/subject-group')->with('success', 'Subject Group Created Successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subjectGroups = SubjectGroup::find($id);
        $subjectGroups->delete();
        return response('Subject Group Deleted Successfully.', 200);
    }
}