<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['user', 'room'])->latest()->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $rooms = Room::all();

        return view('schedules.create', compact('users', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'date' => ['required', 'date'],
        //     'start_session' => ['required', 'date_format:H:i'],
        //     'end_session' => ['required', 'date_format:H:i', 'after:start_session'],
        //     'type' => ['required', 'string', Rule::in(['KBM', 'Lainnya'])],
        //     'user_id' => ['required', 'exists:users,id'],
        //     'room_id' => ['required', 'exists:rooms,id'],
        //     'description' => ['nullable', 'string', 'max:500'],
        //     'recurring' => ['required', 'boolean'],
        //     'recurring_type' => ['nullable', 'string', 'required_if:recurring,true'],
        // ]);

        // Schedule::create([
        //     'date' => $request->date,
        //     'start_session' => $request->start_session,
        //     'end_session' => $request->end_session,
        //     'type' => $request->type,
        //     'user_id' => $request->user_id,
        //     'room_id' => $request->room_id,
        //     'description' => $request->description,
        //     'recurring' => $request->boolean('recurring'),
        //     'recurring_type' => $request->recurring ? $request->recurring_type : null,
        // ]);

        // return redirect()->route(['schedules.store']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['user', 'room']);

        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $users = User::all();
        $rooms = Room::all();

        return view('schedules.edit', compact('schedule', 'users', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedules)
    {
        //
    }
}
