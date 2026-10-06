<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class doaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://equran.id/api/doa');
        //mnegambil data dari api doa
        $doa = $response->json()['data'];
        //mengambul data response dan disimpan ke dalam variabel $doa

        // $doa = $doa[9];
        //mengambil data pertama dari array $doa

        return view('doa', ['doa' => $doa]);  
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
    public function show(string $id)
    {
        $response = Http::get('https://equran.id/api/doa/' . $id);
        //mnegambil data dari api equran
        $doa = $response->json()['data'];
        //mengambul data response dan disimpan ke dalam variabel $doa

        return view('detaildoa', ['doa' => $doa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
