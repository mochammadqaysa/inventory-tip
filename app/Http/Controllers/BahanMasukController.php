<?php

namespace App\Http\Controllers;

use App\DataTables\BahanMasukDataTable;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BahanMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BahanMasukDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.bahan_masuk.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bahan = Bahan::all();
        $body = view('pages.inventory.bahan_masuk.create', compact('bahan'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pemasukan Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(BahanMasuk $bahanMasuk)
    {
        $bahanMasukItems = $bahanMasuk->bahanMasukItems;
        $supplier = $bahanMasuk->supplier;
        $body = view('pages.inventory.bahan_masuk.detail', compact('bahanMasuk', 'bahanMasukItems', 'supplier'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemasukan Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BahanMasuk $bahanMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BahanMasuk $bahanMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BahanMasuk $bahanMasuk)
    {
        //
    }
}
