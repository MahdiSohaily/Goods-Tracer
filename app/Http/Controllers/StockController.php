<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StockController extends Controller
{
    public function index(Stock $stock = null){
        $user = DB::table('users')
            ->where('position', '=', 'معتمد جنسی')
            ->get();
        $category = Category::all();

        $stocks = DB::table('stocks')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->join('categories','categories.id','=','stocks.category_id')
            ->select('stocks.*','users.name as user_name','users.last_name','users.position','categories.name as cat_name')
            ->get();

        return Inertia::render('Stock/Show', [
            'categories' => $category,
            'users' => $user,
            'stocks' => $stocks,
            'stock'=> $stock
        ]);
    }

    public function create(StockRequest $request)
    {
        $stock = new Stock();
        $stock->name = $request->input('name');
        $stock->user_id = $request->input('user_id');
        $stock->category_id = $request->input('category_id');
        $stock->description = $request->input('description');
        $stock->save();
        return $this->index();
    }

    public function update(StockRequest $request) {
        $stock = Stock::find($request->input('id'));

        $stock->name = $request->input('name');
        $stock->user_id = $request->input('user_id');
        $stock->category_id = $request->input('category_id');
        $stock->description = $request->input('description');
        $stock->save();

        return $this->index($stock);
    }
}
