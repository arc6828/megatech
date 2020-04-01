<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use App\CustomerModel;
use Illuminate\Http\Request;

class CommentController extends Controller
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
            $comment = Comment::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('comment', 'LIKE', "%$keyword%")
                ->orWhere('key', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $comment = Comment::latest()->paginate($perPage);
        }

        return view('comment.index', compact('comment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $customer_id = $request->get('customer_id');
        if(!empty($customer_id)){
            $customer = CustomerModel::findOrFail($customer_id);
            $key = "customer";
            $value = $customer_id;
            return view('comment.create' , compact('customer','key','value') );
        }
        
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
        
        $comment = Comment::create($requestData);

        return redirect(''.$comment->key.'/'.$comment->value.'/edit')->with('flash_message', 'Comment added!');
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
        $comment = Comment::findOrFail($id);

        return view('comment.show', compact('comment'));
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
        $comment = Comment::findOrFail($id);

        return view('comment.edit', compact('comment'));
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
        
        $comment = Comment::findOrFail($id);
        $comment->update($requestData);

        return redirect(''.$comment->key.'/'.$comment->value.'/edit')->with('flash_message', 'Comment updated!');
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
        $comment = Comment::findOrFail($id);
        Comment::destroy($id);

        return redirect(''.$comment->key.'/'.$comment->value.'/edit')->with('flash_message', 'Comment deleted!');
    }
}
