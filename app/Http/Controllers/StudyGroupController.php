<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyGroups = StudyGroup::all();

        return view('studygroup.index', compact('studyGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studygroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:50', 'unique:studygroup,name']
        // ]);

        // StudyGroup::create([
        //     'name' => $request->name
        // ]);

        // return redirect()->route('studygroups.index')->with('status', 'Kelas berhasil ditambahkan!! ^-^');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyGroup $studyGroup)
    {
        return view('studygroup.show', compact('studyGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyGroup $studyGroup)
    {
        return view('studygroup.edit', compact('studyGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyGroup $studyGroup)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:50', Rule::unique('studygroups')->ignore($studyGroup->id)]
        // ]);

        // $studyGroup->update([
        //     'name' => $request->name,
        // ]);

        // return redirect()->route('studygroups.show', $studyGroup)->with('status', 'Kelas berhasil di perbarui!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyGroup $studyGroup)
    {
        // $studyGroup->delete();

        // return redirect()->route('studygroups.index')->with('status', 'Kelas berhasil dihapus!!');
    }
}
