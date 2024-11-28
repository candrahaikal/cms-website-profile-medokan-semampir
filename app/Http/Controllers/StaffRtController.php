<?php

namespace App\Http\Controllers;

use App\Models\StaffRt;
use App\Models\MStaffCategory;
use Illuminate\Http\Request;

class StaffRtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rt_id = $request->rt;
        $staffRws = StaffRt::with('rt', 'staffCategory')->where('rt_id', $rt_id)->get();

        return view('pages.staff_rt.index', compact('staffRws', 'rt_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rt_id = $request->rt_id;
        $staffCategories = MStaffCategory::all();

        return view('pages.staff_rt.add', compact('rt_id', 'staffCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $rt_id = $request->rt_id;

        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'staff_category' => 'required',

            'status' => 'nullable', // Status bisa kosong, default dianggap false
        ]);


        try {
            // Simpan data ke database
            StaffRt::create([
                'rt_id' => $rt_id,
                'staff_category_id' => $validatedData['staff_category'],
                'name' => $validatedData['name'],
                'status' => $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('staff-rt.index', ['rt' => $rt_id])->with('success', 'Pegawai RT berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal menyimpan data Pwgawai RT. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffRt  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function show(StaffRt $staffRw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffRt  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $staffRw = StaffRt::findOrFail($request->id);
        $rt_id = $staffRw->rt_id;
        $staffCategories = MStaffCategory::all();

        return view('pages.staff_rt.edit', compact('staffRw', 'rt_id', 'staffCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffRt  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $staffRw = StaffRt::findOrFail($request->id);

        // dd($request->all());

        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'rt_id' => 'required',
            'staff_category' => 'required',
            'status' => 'nullable', // Status bisa kosong, default dianggap false
        ]);



        try {
            // Simpan data ke database
            $staffRw->update([
                'rt_id' => $validatedData['rt_id'],
                'staff_category_id' => $validatedData['staff_category'],
                'name' => $validatedData['name'],
                'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
            ]);



            // Redirect dengan pesan sukses
            return redirect()->route('staff-rt.index', ['rt' => $staffRw->rt_id])->with('success', 'Pegawai RT berhasil diubah.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal mengubah data Pwgawai RT. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffRt  $staffRw
     * @return \Illuminate\Http\Response
     */
    public function destroy($rt_id, $id)
{
    // Cari data StaffRt berdasarkan ID dan RT_ID
    $staffRw = StaffRt::where('id', $id)->where('rt_id', $rt_id)->first();

    if (!$staffRw) {
        return redirect()->route('staff-rt.index', ['rt' => $rt_id])
            ->with('error', 'Data Pegawai RT tidak ditemukan.');
    }

    try {
        // Hapus data
        $staffRw->delete();
        return redirect()->route('staff-rt.index', ['rt' => $rt_id])
            ->with('success', 'Pegawai RT berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('staff-rt.index', ['rt' => $rt_id])
            ->with('error', 'Gagal menghapus Pegawai RT. Silakan coba lagi.');
    }
}

}
