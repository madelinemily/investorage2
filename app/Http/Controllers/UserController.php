<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('user.update', $user->id) . '`)" class="btn btn-xs btn-info btn-flat" style="background-color: #2E4492; border-color: #2E4492;"><i class="fa fa-pencil" style="color: #FFFFFF"></i></button>
                    <button type="button" onclick="deleteData(`' . route('user.destroy', $user->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 2;
        $user->foto = '/img/user.jpg';
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan');
        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "")
            $user->password = bcrypt($request->password);
        $user->update();

        return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui');
        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return response(null, 204);
    }

    public function profil()
    {
        $profil = auth()->user();
        return view('user.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        Validator::extend('match_old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'old_password' => 'nullable|min:5|match_old_password',
            'password' => 'nullable|min:5|confirmed',
            'foto' => 'nullable|image|max:2048',
        ], [
            'name.required' => __('profile.name_required'),
            'name.min' => __('profile.name_min'),
            'old_password.min' => __('profile.old_password_min'),
            'old_password.match_old_password' => __('profile.old_password_invalid'),
            'password.min' => __('profile.new_password_requirement'),
            'password.confirmed' => __('profile.password_mismatch'),
            'foto.image' => __('profile.photo_invalid'),
            'foto.max' => __('profile.photo_max'),
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        // Dapatkan profil pengguna yang sedang login
        $user = auth()->user();

        // Update nama
        $user->name = $request->name;

        // Update password jika diisi
        // if ($request->filled('old_password')) {
        //     if (!Hash::check($request->old_password, $user->password)) {
        //         return response()->json([
        //             'errors' => ['old_password' => __('profile.old_password_invalid')],
        //         ], 422);
        //     }

        //     $user->password = Hash::make($request->password);
        // }

        $user->password = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $user->foto = "/img/$nama";
        }

        $user->update();


        return response()->json($user, 200);
        // // Update foto profil jika ada file diunggah
        // if ($request->hasFile('foto')) {
        //     $fotoPath = $request->file('foto')->store('uploads/profile_photos', 'public');

        //     // Hapus foto lama jika ada
        //     if ($user->foto) {
        //         Storage::disk('public')->delete($user->foto);
        //     }

        //     $user->foto = $fotoPath;
        // }

        // // Simpan perubahan
        // $user->save();

        // return response()->json([
        //     'success' => __('profile.changes_saved'),
        //     'name' => $user->name,
        //     'foto' => $user->foto ? asset('storage/' . $user->foto) : null,
        // ]);
    }
}
