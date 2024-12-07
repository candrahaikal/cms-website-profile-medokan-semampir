<?php

namespace App\Http\Controllers;

use App\Models\FacilityRt;
use App\Models\MRw;
use App\Models\MRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityRtController extends Controller
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

        $facilities = FacilityRt::with('rt')
            ->whereIn('rt_id', $rts->pluck('id'))
            ->get()
            ->groupBy('rt_id'); // Kelompokkan berdasarkan RT

        return view('pages.facility_rt.index', compact('facilities', 'rw', 'rts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rw = MRw::find($request->rw);
        return view('pages.facility_rt.add', compact('rw'));
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
            'name' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|string|nullable',
            'link_maps' => 'required|string|nullable',
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
                'facility', // Folder di dalam 'uploads'
                $randomName,
                'public_uploads' // Disk yang sudah didefinisikan
            );

            // Simpan path ke variabel validated
            $validated['image'] = 'uploads/' . $path;
        }

        $newFacilityRt = FacilityRt::create([
            'rw_id' => $rw->id,
            'name' => $request->name,
            'image' => $validated['image'],
            'description' => $request->description,
            'link_maps' => $request->link_maps,
            'status' => $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
        ]);

        if ($newFacilityRt) {
            return redirect()->route('facility-rw.index', ['rw' => $rw->id])->with('success', 'Data fasilitas berhasil ditambahkan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityRt  $facilityRw
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $facility = FacilityRt::findOrFail($request->id);
        $rw = MRw::find($facility->rw_id);

        return view('pages.facility_rt.edit', compact('facility', 'rw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityRt  $facilityRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $facility = FacilityRt::findOrFail($request->id);
        $rw = MRw::find($facility->rw_id);
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string',
            'link_maps' => 'nullable|string|max:255',
            'status' => 'nullable',
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if (!empty($facility->image) && file_exists(public_path($facility->image))) {
                unlink(public_path($facility->image));
            }

            $image = $request->file('image');

            // Pisahkan nama file asli dan ekstensi
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Buat nama baru dengan tambahan string acak
            $randomName = $originalName . '_' . Str::random(10) . '.' . $extension;

            // Simpan file ke folder 'facility' di disk 'public_uploads'
            $path = $image->storeAs(
                'facility', // Folder di dalam 'uploads'
                $randomName,
                'public_uploads' // Disk yang sudah didefinisikan
            );

            // Simpan path ke variabel validated
            $validated['image'] = 'uploads/' . $path;
        } else {
            $validated['image'] = $facility->image; // Gunakan gambar lama jika tidak ada yang diunggah
        }

        // Update data fasilitas
        $facility->update([
            'name' => $validated['name'],
            'image' => $validated['image'],
            'description' => $validated['description'],
            'link_maps' => $validated['link_maps'],
            'status' => $request->has('status') && $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
        ]);

        // Redirect ke halaman facility.index dengan pesan sukses
        return redirect()->route('facility-rw.index', ['rw' => $rw->id])
            ->with('success', 'Data fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityRt  $facilityRw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $facility = FacilityRt::find($request->id);

        if (!$facility) {
            return redirect()->back()->with('error', 'Data fasilitas tidak ditemukan.');
        }

        // Mengambil path file yang sudah disimpan di database
        $filePath = str_replace('uploads/', '', $facility->image);

        // Hapus file gambar jika ada
        if ($facility->image && Storage::disk('public_uploads')->exists($filePath)) {
            Storage::disk('public_uploads')->delete($filePath);
        }

        // Hapus record dari database
        $facility->delete();

        return redirect()->back()->with('success', 'Data fasilitas berhasil dihapus.');
    }
}
