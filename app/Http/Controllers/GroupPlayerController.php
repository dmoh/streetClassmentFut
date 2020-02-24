<?php

namespace App\Http\Controllers;

use App\GroupPlayer;
use Illuminate\Http\Request;

class GroupPlayerController extends Controller
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
     * @param  \App\GroupPlayer  $groupPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPlayer $groupPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupPlayer  $groupPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPlayer $groupPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupPlayer  $groupPlayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupPlayer $groupPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupPlayer  $groupPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPlayer $groupPlayer)
    {
        //
    }


    public function setGroupChoice(Request $request){
        if($request->ajax()){
            $request->session()->put('groupId', $request->request->get('groupId'));
            $request->session()->put('groupName', $request->request->get('groupName'));
            return response()->json(['ok' => 'session']);
        }
    }
}
