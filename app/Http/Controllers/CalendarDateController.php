<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CalendarDate;
use Illuminate\Http\Request;

class CalendarDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $calendardate = CalendarDate::where('name', 'LIKE', "%$keyword%")
                ->orWhere('pin_date', 'LIKE', "%$keyword%")
                ->orWhere('calendar_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $calendardate = CalendarDate::latest()->paginate($perPage);
        }

        return view('calendar-date.index', compact('calendardate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('calendar-date.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        $calendar_date = CalendarDate::create($requestData);

        return redirect("calendar/".$calendar_date->calendar_id)->with('flash_message', 'CalendarDate added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $calendardate = CalendarDate::findOrFail($id);

        return view('calendar-date.show', compact('calendardate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $calendardate = CalendarDate::findOrFail($id);

        return view('calendar-date.edit', compact('calendardate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $calendardate = CalendarDate::findOrFail($id);
        $calendardate->update($requestData);

        return redirect('calendar-date')->with('flash_message', 'CalendarDate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        CalendarDate::destroy($id);

        return redirect('calendar-date')->with('flash_message', 'CalendarDate deleted!');
    }
}
