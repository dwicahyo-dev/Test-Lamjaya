<?php

namespace App\Http\Controllers;

use App\DataTables\KelurahanDataTable;
use App\Http\Requests\StoreKelurahanRequest;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KelurahanDataTable $dataTable)
    {
        return $dataTable->render('kelurahan.index', [
            'kecamatans' => Kecamatan::all(),
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
    public function store(StoreKelurahanRequest $request)
    {
        DB::transaction(function () use ($request) {
            Kelurahan::create([
                'name' => $request->name,
                'kecamatan_id' => $request->kecamatan_id,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(StoreKelurahanRequest $request, Kelurahan $kelurahan)
    {
        DB::transaction(function () use ($request, $kelurahan) {
            $kelurahan->update([
                'kecamatan_id' => $request->kecamatan_id,
                'name' => $request->name,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        DB::transaction(function () use ($kelurahan) {
            $kelurahan->delete();
        });

        return response()->noContent(204);
    }
}
