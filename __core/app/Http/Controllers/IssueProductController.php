<?php

namespace App\Http\Controllers;

use App\Models\issueProduct;
use App\Services\EventService;
use App\Services\IssueService;
use Illuminate\Http\Request;

class IssueProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['moduleController'] = 'issueProduct';
        $data['eventNumber'] = (new EventService)->getList();
        return view('backend.pages.issueProduct.index', $data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\issueProduct  $issueProduct
     * @return \Illuminate\Http\Response
     */
    public function show(issueProduct $issueProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\issueProduct  $issueProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(issueProduct $issueProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\issueProduct  $issueProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, issueProduct $issueProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\issueProduct  $issueProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(issueProduct $issueProduct)
    {
        //
    }
}
