<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Menampilkan data kategori dalam format yang kompatibel dengan DataTables.
     */
    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('kategori.update', $kategori->id_kategori) .'`)" class="btn btn-xs btn-info btn-flat" style="background-color: #2E4492; border-color: #2E4492;"><i class="fa fa-pencil" style="color: #fff"></i></button>
                    <button onclick="deleteData(`'. route('kategori.destroy', $kategori->id_kategori) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Simpan data baru kategori.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Simpan data kategori baru
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Tampilkan data kategori berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($kategori);
    }

    /**
     * Update data kategori yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Cari dan update data kategori
        $kategori = Kategori::find($id);
        
        if (!$kategori) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return redirect()->route('kategori.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Hapus data kategori berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $kategori->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 204);
    }
}
