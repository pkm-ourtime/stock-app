<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class POSController extends Controller
{
    public function index()
    {
        $stockItems = Item::where('quantity', '>', 0)->get();
        return view('pos.index', compact('stockItems'));
    }

    public function processSale(Request $request)
    {
        $items = $request->input('items');

        DB::beginTransaction();
        try {
            foreach ($items as $item) {
                $stockItem = Item::find($item['id']);
                if ($stockItem && $stockItem->quantity >= $item['quantity']) {
                    $stockItem->quantity -= $item['quantity'];
                    $stockItem->save();
                } else {
                    throw new \Exception('Insufficient stock for item: ' . $stockItem->name);
                }
            }
            DB::commit();
            return response()->json(['success' => 'Sale processed successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
