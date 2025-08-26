<?php

namespace App\Http\Controllers;

use App\Http\Libs\SubjectLib;
use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    private $subject_lib;

    public function __construct(SubjectLib $subject_lib)
    {
        $this->subject_lib = $subject_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = $this->subject_lib->index();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->subject_lib->getGrades();
        return view('subjects.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $data = $request->validated();
        $this->subject_lib->store($data);

        return redirect()->route('subjects.index')->with('success', 'Subject has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubjectRequest $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
