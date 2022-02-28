<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function redirecttologin()
    {
        # code...
        return redirect()->route('login');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Application::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'ic_no' => $request->ic_no,
            'email' => $request->email,
            'gander' => $request->gander,
            'current_status' => $request->current_status,
            'current_institution' => $request->current_institution,
            'get_know_obrien' => $request->get_know_obrien,
            'funding' => $request->funding,

            'status' => 0,

            'year' => Carbon::now()->format('Y')
        ]);

        return response()->json(['success'=>'Ajax request submitted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
