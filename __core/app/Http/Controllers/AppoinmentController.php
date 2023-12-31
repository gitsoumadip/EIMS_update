<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Services\AppointmentService as SELF_SERVICE;
use Illuminate\Http\Request;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['moduleController'] = 'appointment';
        return view('backend.pages.appointment.index', $data);
    }
    /**
     * Return a listing of the resource with limit offset and filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        // dd($request->toArray());
        $result = (new SELF_SERVICE)->fetch($request);
            return [
            "recordsTotal" => $result['count'],
            "recordsFiltered" => $result['count'],
            "data" =>  $result['data']
        ];
        // dd($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return (new SELF_SERVICE)->insert($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return (new SELF_SERVICE)->get_edit_form($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return (new SELF_SERVICE)->update($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return (new SELF_SERVICE)->delete(($request->has('delete_array')) ? $request->input('delete_array') : [$id]);
    }
}
