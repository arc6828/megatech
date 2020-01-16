<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FullCalendar;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
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
        $mode = ""; 
        $value = "";
        if(! empty( request('customer_id') ) ){ //CUSTOMER
            $mode = "customer";
            $value = request('customer_id');
        }else if(! empty( request('supplier_id') ) ){ //SUPPLIER
            $mode = "supplier";
            $value = request('supplier_id');
        }
        $fullcalendar = FullCalendar::where($mode.'_id',$value)->orderBy('start', 'desc')->paginate($perPage);
        /*
        if (!empty($keyword)) {
            $fullcalendar = FullCalendar::where('title', 'LIKE', "%$keyword%")
                ->orWhere('start', 'LIKE', "%$keyword%")
                ->orWhere('end', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('supplier_id', 'LIKE', "%$keyword%")
                ->orderBy('start', 'desc')->paginate($perPage);
        } else {
            $fullcalendar = FullCalendar::orderBy('start', 'desc')->paginate($perPage);
        }*/

        return view('full-calendar.index', compact('fullcalendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('full-calendar.create');
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
        
        $full_calendar = FullCalendar::create($requestData);
        //ADD CUSTOMER ID IN URL
        $mode = ""; 
        $value = "";
        if(isset($full_calendar->customer_id ) ){ //CUSTOMER
            $mode = "customer";
            $value = $full_calendar->customer_id;
        }else if(isset($full_calendar->supplier_id)  ){ //SUPPLIER
            $mode = "supplier";
            $value = $full_calendar->supplier_id;
        }

        return redirect("full-calendar?{$mode}_id={$value}")->with('flash_message', 'FullCalendar added!');
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
        $fullcalendar = FullCalendar::findOrFail($id);

        return view('full-calendar.show', compact('fullcalendar'));
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
        $fullcalendar = FullCalendar::findOrFail($id);

        return view('full-calendar.edit', compact('fullcalendar'));
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
        
        $fullcalendar = FullCalendar::findOrFail($id);
        $fullcalendar->update($requestData);

        //ADD CUSTOMER ID IN URL
        $mode = ""; 
        $value = "";
        if(isset($fullcalendar->customer_id ) ){ //CUSTOMER
            $mode = "customer";
            $value = $fullcalendar->customer_id;
        }else if(isset($fullcalendar->supplier_id)  ){ //SUPPLIER
            $mode = "supplier";
            $value = $fullcalendar->supplier_id;
        }

        return redirect("full-calendar?{$mode}_id={$value}")->with('flash_message', 'FullCalendar added!');
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
        FullCalendar::destroy($id);

        return redirect('full-calendar')->with('flash_message', 'FullCalendar deleted!');
    }
}
