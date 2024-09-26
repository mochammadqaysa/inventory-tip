<?php

namespace App\Http\Controllers;

use App\DataTables\WasteKeluarDataTable;
use App\Models\WasteKeluar;
use Illuminate\Http\Request;

class WasteKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WasteKeluarDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.waste_masuk.list');
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
    public function show(WasteKeluar $wasteKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteKeluar $wasteKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteKeluar $wasteKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WasteKeluar $wasteKeluar)
    {
        //
    }
}
