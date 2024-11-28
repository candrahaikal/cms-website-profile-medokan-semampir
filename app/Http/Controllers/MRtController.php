<?php

namespace App\Http\Controllers;

use App\Models\MRt;
use App\Models\MRw;
use Illuminate\Http\Request;

class MRtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rts = MRt::with('rw')->get();
        return view('pages.m_rt.index', compact('rts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rws = MRw::all();
        return view('pages.m_rt.add', compact('rws'));
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
            'rw' => 'required', // Pastikan RW ID valid
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'status' => 'nullable|boolean', // Status bisa kosong, default dianggap false
        ]);


        try {
            // Simpan data ke database
            Mrt::create([
                'rw_id' => $validatedData['rw'],
                'name' => $validatedData['name'],
                'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
            ]);



            // Redirect dengan pesan sukses
            return redirect()->route('rt.index')->with('success', 'RT berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal menyimpan data RT. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MRt  $mRt
     * @return \Illuminate\Http\Response
     */
    public function show(MRt $mRt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MRt  $mRt
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $rws = MRw::all();
        $rt = MRt::with('rw')->find($request->id);
        return view('pages.m_rt.edit', [
            'rws' => $rws,
            'rt' => $rt
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MRt  $mRt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'rw' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $rt = MRt::findOrFail($request->id);
        $rt->update([
            'rw_id' => $request->rw,
            'name' => $request->name,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MRt  $mRt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rt = MRt::findOrFail($request->id);
        $rt->delete();
        return redirect()->route('rt.index')->with('success', 'Data RT berhasil dihapus.');
    }
}
