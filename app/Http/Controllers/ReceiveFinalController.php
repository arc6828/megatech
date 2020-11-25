<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReceiveFinal;
use Illuminate\Http\Request;

class ReceiveFinalController extends Controller
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
            $receivefinal = ReceiveFinal::where('code', 'LIKE', "%$keyword%")
                ->orWhere('is_code', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('revision', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $receivefinal = ReceiveFinal::latest()->paginate($perPage);
        }

        return view('receive-final.index', compact('receivefinal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('receive-final.create');
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
        
        ReceiveFinal::create($requestData);

        return redirect('receive-final')->with('flash_message', 'ReceiveFinal added!');
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
        $receivefinal = ReceiveFinal::findOrFail($id);

        return view('receive-final.show', compact('receivefinal'));
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
        $receivefinal = ReceiveFinal::findOrFail($id);

        return view('receive-final.edit', compact('receivefinal'));
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
        
        $receivefinal = ReceiveFinal::findOrFail($id);
        $receivefinal->update($requestData);

        return redirect('receive-final')->with('flash_message', 'ReceiveFinal updated!');
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
        ReceiveFinal::destroy($id);

        return redirect('receive-final')->with('flash_message', 'ReceiveFinal deleted!');
    }
}
