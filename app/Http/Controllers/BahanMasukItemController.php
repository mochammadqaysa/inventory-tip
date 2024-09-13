<?php

namespace App\Http\Controllers;

use App\Models\BahanMasukItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BahanMasukItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BahanMasukItem $bahanMasukItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BahanMasukItem $bahanMasukItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BahanMasukItem $bahanMasukItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BahanMasukItem $bahanMasukItem)
    {
        //
    }

    public function datatable(Request $request)
    {
        $data = $request->all();
        $query = BahanMasukItem::query();

        // if ($request->has('tanggal')) {
        //     $query->whereDate('tanggal', $request->input('tanggal'));
        // }

        // Return the data to DataTables
        $table = DataTables::of($query)
            // ->addColumn('action', function ($row) {
            //     return '<a href="/edit/' . $row->id . '" class="btn btn-sm btn-primary">Edit</a>';
            // })
            ->make(true);

        return $table;
    }
}
