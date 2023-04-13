<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = Rate::all();
        return Inertia::render('Rate/Show',['rates'=>$rates, 'tab'=> 'create']);
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
        $validated = $request->validate([
            'rate' => 'required|integer|min:0',
        ]);

        $rate = new Rate();
        $rate-> rate = $request->input('rate');
        $rate->save();

        return $this->index();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        return $rate;
        $rates = Rate::all();
        return Inertia::render('Rate/Show',[
            'rates'=>$rates,
            'tab'=> 'create',
            'current'=> $rate
        ]);
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
    public function deleteRate(Rate $rate)
    {
        $rate->delete();
        $rates = Rate::all();
        return Inertia::render('Rate/Show',['rates'=>$rates, 'tab'=> 'list']);
    }
}
