<?php

namespace App\Http\Controllers;

use App\DataTables\KecamatanDataTable;
use App\Http\Requests\StoreKecamatanRequest;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KecamatanDataTable $dataTable)
    {
        return $dataTable->render('kecamatan.index', [
            'provinsis' => Provinsi::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKecamatanRequest $request)
    {
        DB::transaction(function () use ($request) {
            Kecamatan::create([
                'name' => $request->name,
                'provinsi_id' => $request->provinsi_id,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        DB::transaction(function () use ($request, $kecamatan) {
            $kecamatan->update([
                'provinsi_id' => $request->provinsi_id,
                'name' => $request->name,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        DB::transaction(function () use ($kecamatan) {
            $kecamatan->delete();
        });

        return response()->noContent(204);
    }
}
