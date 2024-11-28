<?php

namespace App\Http\Controllers;

use App\Models\StaffRw;
use App\Models\MStaffCategory;
use Illuminate\Http\Request;

class StaffRwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rw_id = $request->rw;
        $staffRws = StaffRw::with('rw', 'staffCategory')->where('rw_id', $rw_id)->get();

        return view('pages.staff_rw.index', compact('staffRws', 'rw_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rw_id = $request->rw_id;
        $staffCategories = MStaffCategory::all();

        return view('pages.staff_rw.add', compact('rw_id', 'staffCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rw_id = $request->rw_id;

        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'staff_category' => 'required',

            'status' => 'nullable', // Status bisa kosong, default dianggap false
        ]);


        try {
            // Simpan data ke database
            StaffRw::create([
                'rw_id' => $rw_id,
                'staff_category_id' => $validatedData['staff_category'],
                'name' => $validatedData['name'],
                'status' => $request->status == 'on' ? 1 : 0, // Checkbox menghasilkan boolean
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('staff-rw.index', ['rw' => $rw_id])->with('success', 'Pegawai RW berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal menyimpan data Pwgawai RW. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffRw  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function show(StaffRw $staffRw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffRw  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $staffRw = StaffRw::findOrFail($request->id);
        $rw_id = $staffRw->rw_id;
        $staffCategories = MStaffCategory::all();

        return view('pages.staff_rw.edit', compact('staffRw', 'rw_id', 'staffCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffRw  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $staffRw = StaffRw::findOrFail($request->id);

        // dd($request->all());

        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'rw_id' => 'required',
            'staff_category' => 'required',
            'status' => 'nullable', // Status bisa kosong, default dianggap false
        ]);



        try {
            // Simpan data ke database
            $staffRw->update([
                'rw_id' => $validatedData['rw_id'],
                'staff_category_id' => $validatedData['staff_category'],
                'name' => $validatedData['name'],
                'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
            ]);



            // Redirect dengan pesan sukses
            return redirect()->route('staff-rw.index', ['rw' => $staffRw->rw_id])->with('success', 'Pegawai RW berhasil diubah.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal mengubah data Pwgawai RW. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffRw  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function destroy($rw_id, $id)
{
    // Cari data StaffRw berdasarkan ID dan RW_ID
    $staffRw = StaffRw::where('id', $id)->where('rw_id', $rw_id)->first();

    if (!$staffRw) {
        return redirect()->route('staff-rw.index', ['rw' => $rw_id])
            ->with('error', 'Data Pegawai RW tidak ditemukan.');
    }

    try {
        // Hapus data
        $staffRw->delete();
        return redirect()->route('staff-rw.index', ['rw' => $rw_id])
            ->with('success', 'Pegawai RW berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('staff-rw.index', ['rw' => $rw_id])
            ->with('error', 'Gagal menghapus Pegawai RW. Silakan coba lagi.');
    }
}

}
