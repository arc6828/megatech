<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Numberun;
use Illuminate\Http\Request;

class NumberunController extends Controller
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
            $numberun = Numberun::where('name_doc', 'LIKE', "%$keyword%")
                ->orWhere('datetime_doc', 'LIKE', "%$keyword%")
                ->orWhere('number_doc', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $numberun = Numberun::latest()->paginate($perPage);
        }

        return view('numberun.index', compact('numberun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('numberun.create');
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
        
        Numberun::create($requestData);

        return redirect('numberun')->with('flash_message', 'Numberun added!');
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
        $numberun = Numberun::findOrFail($id);

        return view('numberun.show', compact('numberun'));
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
        $numberun = Numberun::findOrFail($id);

        return view('numberun.edit', compact('numberun'));
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
        
        $numberun = Numberun::findOrFail($id);
        $numberun->update($requestData);

        return redirect('numberun')->with('flash_message', 'Numberun updated!');
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
        Numberun::destroy($id);

        return redirect('numberun')->with('flash_message', 'Numberun deleted!');
    }
}
