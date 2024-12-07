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
    public function index(Request $request)
    {

        if ($request->has('rw_id')) {

            $rts = MRt::with('rw')->where('rw_id', $request->rw_id)->get();
        } else {
            $rts = MRt::with('rw')->get();
        }
        return view('pages.m_rt.index', [
            'rts' => $rts,
            'rw_id' => $request->rw_id
        ]);
    }


    // Show RT based on RW id
    public function indexByRw(Request $request)
    {
        $rts = MRt::with('rw')->where('rw_id', $request->id)->get();
        return view('pages.m_rt.index', compact('rts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rw_id = $request->rw_id;
        // dd($rw_id);
        if ($rw_id) {
            return view('pages.m_rt.add', compact('rw_id'));
        } else {
            $rw_id = null;
        }
        // $rws = MRw::all();
        return view('pages.m_rt.add', compact('rws', 'rw_id'));
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
            'rw_id' => 'required', // Pastikan RW ID valid
            'name' => 'required|string|max:255', // Nama RT wajib diisi
            'status' => 'nullable', // Status bisa kosong, default dianggap false
            'description' => 'nullable|string',
            'kk' => 'nullable|numeric',
            'population' => 'nullable|numeric',
        ]);

        // dd($validatedData);

        try {
            // Simpan data ke database
            $mrt = Mrt::create([
                'rw_id' => $validatedData['rw_id'],
                'name' => strtoupper($validatedData['name']),
                'status' => $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
                'description' => $validatedData['description'],
                'kk' => $validatedData['kk'],
                'population' => $validatedData['population'],
            ]);

            // dd($mrt);

            // Redirect dengan pesan sukses
            return redirect()->route('rt.index', ['rw_id' => $validatedData['rw_id']])->with('success', 'RT berhasil ditambahkan.');

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
        // $rw_id = $request->rw_id;
        $rt_id = $request->id;

        if($rt_id) {
            $rt = MRt::with('rw')->find($rt_id);

            return view('pages.m_rt.edit', [
                'rw_id' => $rt->first()->rw->id,
                'rt' => $rt
            ]);
        }

        // return view('pages.m_rt.edit', [
        //     'rws' => $rws,
        //     'rt' => $rt
        // ]);
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
        $rt = $request->id;

        $request->validate([
            // 'rw_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kk' => 'nullable|numeric',
            'population' => 'nullable|numeric',
            'status' => 'nullable',
        ]);

        $rt = MRt::findOrFail($request->id);

        $rt->update([
            'rw_id' => $rt->rw_id,
            'name' => $request->name,
            'description' => $request->description,
            'kk' => $request->kk,
            'population' => $request->population,
            'status' => $request->status === "on" ? 1 : 0,
        ]);

        return redirect()->route('rt.index', ['rw_id' => $rt->rw_id])->with('success', 'Data RT berhasil diperbarui.');
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
        $rw_id = $rt->rw_id;

        $rt->delete();
        return redirect()->route('rt.index', ['rw_id' => $rw_id])->with('success', 'Data RT berhasil dihapus.');
    }
}
