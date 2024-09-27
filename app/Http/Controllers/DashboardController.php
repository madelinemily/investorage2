<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $kategori = Kategori::count();
        $produk = Produk::count();

        return view('dashboard', compact('kategori', 'produk'));
    }
}
