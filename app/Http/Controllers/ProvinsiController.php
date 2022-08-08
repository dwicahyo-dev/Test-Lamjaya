<?php

namespace App\Http\Controllers;

use App\DataTables\ProvinsiDataTable;
use App\Http\Requests\StoreProvinsiRequest;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProvinsiDataTable $dataTable)
    {
        return $dataTable->render('provinsi.index');
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
    public function store(StoreProvinsiRequest $request)
    {
        DB::transaction(function () use ($request) {
            Provinsi::create([
                'name' => $request->name,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        DB::transaction(function () use ($request, $provinsi) {
            $provinsi->update([
                'name' => $request->name,
            ]);
        });

        return response()->noContent(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        DB::transaction(function () use ($provinsi) {
            $provinsi->delete();
        });

        return response()->noContent(204);
    }
}
