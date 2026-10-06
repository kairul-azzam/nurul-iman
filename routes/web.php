<?php

use Illuminate\Support\Facades\Route;

Route::resource('quran', \App\Http\Controllers\QuranController::class);
Route::resource('doa', \App\Http\Controllers\doaController::class);
Route::resource('jadwal', \App\Http\Controllers\jadwalController::class);
Route::resource('detailquran', \App\Http\Controllers\QuranController::class);
Route::resource('/', \App\Http\Controllers\PostController::class);
Route::get('/produk/1', function () {
    return response()->json([
        'id' => 1,
        'nama' => 'Produk 1',
        'harga' => 10000,
        'kategori' => 'Pakaian',
        'stok' => 10
    ]);
});

Route::get('/produk/2', function () {
    return response()->json([
        'id' => 2,
        'nama' => 'Produk 2',
        'harga' => 20000,
        'kategori' => 'Elektronik',
        'stok' => 5
    ]);
});

Route::get('/produk/3', function () {
    return response()->json([
        'id' => 3,
        'nama' => 'Produk 3',
        'harga' => 15000,
        'kategori' => 'Buku',
        'stok' => 15
    ]);
});

Route::get('/produk/4', function () {
    return response()->json([
        'id' => 4,
        'nama' => 'Produk 4',
        'harga' => 25000,
        'kategori' => 'Pakaian',
        'stok' => 8
    ]);
});

Route::get('/produk/5', function () {
    return response()->json([
        'id' => 5,
        'nama' => 'Produk 5',
        'harga' => 30000,
        'kategori' => 'Elektronik',
        'stok' => 50
    ]);
});

Route::get('/produk/6', function () {
    return response()->json([
        'id' => 6,
        'nama' => 'Produk 6',
        'harga' => 35000,
        'kategori' => 'Buku',
        'stok' => 25
    ]);
});

Route::get('/produk', function () {
    return response()->json([
        [
        'id' => 2,
        'nama' => 'Produk 2',
        'harga' => 20000,
        'kategori' => 'Elektronik',
        'stok' => 5
    ],
    [
        'id' => 3,
        'nama' => 'Produk 3',
        'harga' => 15000,
        'kategori' => 'Buku',
        'stok' => 15
    ],
    [
        'id' => 4,
        'nama' => 'Produk 4',
        'harga' => 25000,
        'kategori' => 'Pakaian',
        'stok' => 8
    ],
    [
        'id' => 5,
        'nama' => 'Produk 5',
        'harga' => 30000,
        'kategori' => 'Elektronik',
        'stok' => 50
    ],
    [
        'id' => 6,
        'nama' => 'Produk 6',
        'harga' => 35000,
        'kategori' => 'Buku',
        'stok' => 25    
    ]
    ]);
});

Route::resource('quotes', \App\Http\Controllers\QuoteController::class);