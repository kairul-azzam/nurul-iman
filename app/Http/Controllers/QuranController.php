<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://equran.id/api/v2/surat');
        //mnegambil data dari api equran
        $quran = $response->json()['data'];
        //mengambul data response dan disimpan ke dalam variabel $qurans

        // $quran = $qurans[9];
        //mengambil data pertama dari array $qurans

        return view('quran', ['quran' => $quran]);  
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
    public function show(string $nomor)
    {
        $response = Http::get('https://equran.id/api/v2/surat/' . $nomor);
        //mnegambil data dari api equran
        $quran = $response->json()['data'];
        //mengambul data response dan disimpan ke dalam variabel $qurans

        return view('detailquran', ['quran' => $quran]);


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
