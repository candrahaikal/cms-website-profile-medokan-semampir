<?php

namespace App\Http\Controllers;

use App\Models\MRw;
use App\Models\MRt;
use App\Models\StaffRw;
use Illuminate\Http\Request;

class MRwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rws = MRw::all();
        return view('pages.m_rw.index', compact('rws'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.m_rw.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'status' => 'nullable|boolean', // Status bisa kosong, default dianggap false
        ]);


        try {
            // Simpan data ke database
            Mrw::create([
                'name' => $validatedData['name'],
                'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
            ]);



            // Redirect dengan pesan sukses
            return redirect()->route('rw.index')->with('success', 'RW berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal menyimpan data RW. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MRw  $mRw
     * @return \Illuminate\Http\Response
     */
    public function show(MRw $mRw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MRw  $mRw
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $rw = MRw::findOrFail($request->id);
        return view('pages.m_rw.edit', compact('rw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MRw  $mRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $rw = MRw::findOrFail($request->id);
        $rw->update([
            'name' => $request->name,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MRw  $mRw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rw = MRw::findOrFail($request->id);

        $rts = MRt::where('rw_id', $rw->id)->get();

        foreach ($rts as $rt) {
            $staffRws = StaffRw::where('rw_id', $rw->id)->get();
            foreach ($staffRws as $staffRw) {
                $staffRw->delete();
            }
            $rt->delete();
        }
        $rw->delete();
        return redirect()->route('rw.index')->with('success', 'Data RW berhasil dihapus.');
    }
}
