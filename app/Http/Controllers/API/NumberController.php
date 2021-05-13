<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Numberun;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberrun = Numberun::all();

        return response()->json($numberrun);}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $numberrun = new Numberun;
        $numberrun->name_doc = $request->name_doc;
        $numberrun->number_doc = $request->number_doc;
        $numberrun->datetime_doc = $request->datetime_doc;
        $numberrun->number_en = $request->number_en;

        $result = $numberrun->save();

        if ($result) {
            return $numberrun;
        } else {
            return ["Result" => "ERROR"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id ? Numberun::find($id) : Numberun::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $numberrun = Numberun::find($request->id);
        $numberrun->name_doc = $request->name_doc;
        $numberrun->number_doc = $request->number_doc;
        $numberrun->datetime_doc = $request->datetime_doc;
        $numberrun->number_en = $request->number_en;

        $result = $numberrun->save();

        if ($result) {
            return $numberrun;
        } else {
            return ["Result" => "ERROR"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
