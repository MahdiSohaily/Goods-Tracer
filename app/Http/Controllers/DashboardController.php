<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $demands = null;
        $user = Auth::user();
        $exchangerates = Good::all();
        $goodsCount = Good::all();

        return Inertia::render('Dashboard', [
            'accounts' => $user->count(),
            'goodsCount' => $goodsCount->count(),
            'rates' => $exchangerates->count(),
            'position' => $user->position
        ]);
    }
}
