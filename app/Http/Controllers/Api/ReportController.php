<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        //There's probably a more Eloquent way of doing this
        $report = DB::table('items')
            ->select('locations.name as location', 'parent.name as parentCategory', 'categories.name as category', DB::raw('COUNT(items.id) as count'))
            ->leftJoin('locations', 'items.location_id', '=', 'locations.id')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
            ->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->groupBy('items.location_id', 'items.category_id', 'locations.name', 'parent.name', 'categories.name');
        
        if($request->input('price'))
            $report->where('items.price', '>=', $request->input('price'));

        return response()->json($report->get());
    }
}
