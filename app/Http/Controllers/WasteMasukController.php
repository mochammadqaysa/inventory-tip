<?php

namespace App\Http\Controllers;

use App\DataTables\WasteMasukDataTable;
use App\Models\Waste;
use App\Models\WasteMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WasteMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WasteMasukDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.waste_masuk.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $waste = Waste::all();
        $body = view('pages.inventory.waste_masuk.create', compact('waste'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pemasukan Waste / Scrap',
            'body' => $body,
            'footer' => $footer
        ];
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
    public function show(WasteMasuk $wasteMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteMasuk $wasteMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteMasuk $wasteMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WasteMasuk $wasteMasuk)
    {
        //
    }
}
