<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodRequest;
use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GoodController extends Controller
{
    public function index()
    {
        $goods = Good::all();

        return Inertia::render('Good/Show', [
            'goods' => $goods,
            'tab' => 'create'
        ]);
    }

    public function createGood(GoodRequest $request)
    {
        /* Creating Good object an assigning incoming filtered data in order to create new record in database */
        $good = new Good();

        /* instead of  writing duplicate code we used index function to get back to Goods Show page with it's related
           data */
        $this->setup($request, $good);

        $good->save();
        
        return $this->index();
    }

    public function editGood(Good $good)
    {
        // fetch data
        $goods = Good::all();

        return Inertia::render('Good/Partials/ShowGood', [
            'goods' => $goods,
            'good' => $good,
            'tab' => 'edit',
        ]);
    }

    public function updateGood(GoodRequest $request)
    {
        $good = Good::find($request->input('id'));
        // utilizing utility class
        $this->setup($request, $good);
        $good->save();

        return $this->editGood($good);
    }

    public function deleteGood($good) {
        DB::table('goods')->where('id', '=', $good)->delete();
        $goods = Good::all();

        return Inertia::render('Good/Show', [
            'goods' => $goods,
            'tab' => 'list'
        ]);
    }

    // utility function inorder to prevent duplicate code
    public function setup(GoodRequest $request, Good $good)
    {
        $good->serial = $request->input('serial');
        $good->price = $request->input('price');
        $good->weight = $request->input('weight');
        $good->dollarRate = $request->input('dollar');
    }

}
