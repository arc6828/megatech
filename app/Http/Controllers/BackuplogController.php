<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backuplog;
use Illuminate\Http\Request;

class BackuplogController extends Controller
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
            $backuplog = Backuplog::where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('filename', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $backuplog = Backuplog::latest()->paginate($perPage);
        }

        return view('backuplog.index', compact('backuplog'));
    }
    
    public function download($file_name)     {         
        return response()->download(storage_path("app/backup/{$file_name}"));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backuplog.create');
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
                if ($request->hasFile('filename')) {
            $requestData['filename'] = $request->file('filename')
                ->store('backup');
        }

        Backuplog::create($requestData);

        return redirect('backuplog')->with('flash_message', 'Backuplog added!');
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
        $backuplog = Backuplog::findOrFail($id);

        return view('backuplog.show', compact('backuplog'));
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
        $backuplog = Backuplog::findOrFail($id);

        return view('backuplog.edit', compact('backuplog'));
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
                if ($request->hasFile('filename')) {
            $requestData['filename'] = $request->file('filename')
                ->store('backup');
        }

        $backuplog = Backuplog::findOrFail($id);
        $backuplog->update($requestData);

        return redirect('backuplog')->with('flash_message', 'Backuplog updated!');
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
        Backuplog::destroy($id);

        return redirect('backuplog')->with('flash_message', 'Backuplog deleted!');
    }
}
