<?php

namespace App\Http\Controllers;

use App\DataTables\WasteKeluarDataTable;
use App\Models\Customer;
use App\Models\JenisWaste;
use App\Models\Waste;
use App\Models\WasteKeluar;
use Illuminate\Http\Request;

class WasteKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WasteKeluarDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.waste_keluar.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $waste = Waste::all();
        $jenisWaste = JenisWaste::all();
        $body = view('pages.inventory.waste_keluar.create', compact('customer', 'waste', 'jenisWaste'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pengeluaran Waste / Scrap',
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
