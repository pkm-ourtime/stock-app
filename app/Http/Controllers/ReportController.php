<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalQuantity = Item::sum('quantity');
        $lowestStock = Item::orderBy('quantity', 'asc')->first();
        $highestStock = Item::orderBy('quantity', 'desc')->first();
        $items = Item::all();

        return view('reports.index', compact('totalItems', 'totalQuantity', 'lowestStock', 'highestStock', 'items'));
    }
}
