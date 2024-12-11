<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\MRt;
use App\Models\MRw;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rw = MRw::find($request->rw);
        $rts = MRt::where('rw_id', $rw->id)->get();

        $umkms = Umkm::with('rt')
            ->whereIn('rt_id', $rts->pluck('id'))
            ->get()
            ->groupBy('rt_id'); // Kelompokkan berdasarkan RT

        // dd($umkms);
        return view('pages.umkm.index', compact('umkms', 'rw', 'rts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rw = MRw::find($request->rw);
        $rts = MRt::where('rw_id', $rw->id)->get();

        return view('pages.umkm.add', compact('rw', 'rts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rw = MRw::find($request->rw);

        $validated = $request->validate([
            'rt' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|string|nullable',
            'contact' => 'nullable',
            'link_maps' => 'nullable',
            'link_order' => 'nullable',
            'status' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Pisahkan nama file asli dan ekstensi
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Buat nama baru dengan tambahan string acak
            $randomName = $originalName . '_' . Str::random(10) . '.' . $extension;

            // Simpan file ke folder 'facility' di disk 'public_uploads'
            $path = $image->storeAs(
                'umkm', // Folder di dalam 'uploads'
                $randomName,
                'public_uploads' // Disk yang sudah didefinisikan
            );

            // Simpan path ke variabel validated
            $validated['image'] = 'uploads/' . $path;
        }

        $newUmkm = Umkm::create([
            'rt_id' => $validated['rt'],
            'rw_id' => $rw->id,
            'name' => $validated['name'],
            'image' => $request->hasFile('image') ? $validated['image'] : null,
            'description' => $validated['description'],
            'contact' => $validated['contact'],
            'link_order' => $validated['link_order'],
            'link_maps' => $validated['link_maps'],
            'status' => $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
        ]);

        if ($newUmkm) {
            return redirect()->route('umkm.index', ['rw' => $rw->id])->with('success', 'Data UMKM berhasil ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Umkm  $umkm
     * @return \Illuminate\Http\Response
     */
    public function show(Umkm $umkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Umkm  $umkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $umkm = Umkm::findOrFail($request->id);
        $rt = MRt::find($umkm->rt_id);
        $rw = MRw::find($rt->rw_id);
        $rts = MRt::where('rw_id', $rw->id)->get();

        return view('pages.umkm.edit', compact('umkm', 'rw', 'rts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Umkm  $umkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $umkm = Umkm::findOrFail($request->id);
        $rw = MRw::find($umkm->rt->rw->id);

        // dd($rw);

        $validated = $request->validate([
            'rt' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string',
            'contact' => 'nullable',
            'link_maps' => 'nullable|string',
            'link_order' => 'nullable|string',
            'status' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Pisahkan nama file asli dan ekstensi
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Buat nama baru dengan tambahan string acak
            $randomName = $originalName . '_' . Str::random(10) . '.' . $extension;

            // Hapus gambar lama jika ada
            if ($umkm->image && Storage::disk('public_uploads')->exists($umkm->image)) {
                Storage::disk('public_uploads')->delete($umkm->image);
            }

            // Simpan file ke folder 'umkm' di disk 'public_uploads'
            $path = $image->storeAs(
                'umkm',
                $randomName,
                'public_uploads'
            );

            // Simpan path ke variabel validated
            $validated['image'] = 'uploads/' . $path;
        }

        $umkm->update([
            'rt_id' => $validated['rt'],
            'name' => $validated['name'],
            'image' => $validated['image'] ?? $umkm->image, // Jika tidak ada gambar baru, gunakan gambar lama
            'description' => $validated['description'],
            'contact' => $validated['contact'],
            'link_maps' => $validated['link_maps'],
            'link_order' => $validated['link_order'],
            'status' => $request->status === "on" ? 1 : 0,
        ]);

        return redirect()->route('umkm.index', ['rw' => $rw->id])->with('success', 'Data UMKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Umkm  $umkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $umkm = Umkm::findOrFail($request->id);
        $rw = MRw::find($umkm->rt->rw->id);
        $umkm->delete();
        return redirect()->route('umkm.index', ['rw' => $rw->id])->with('success', 'Data UMKM berhasil dihapus.');
    }
}
