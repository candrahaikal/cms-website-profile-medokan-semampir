<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\MRt;
use App\Models\MRw;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
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

        $events = Event::with('rt')
            ->whereIn('rt_id', $rts->pluck('id'))
            ->get()
            ->groupBy('rt_id'); // Kelompokkan berdasarkan RT

        // dd($events);
        return view('pages.events.index', compact('events', 'rw', 'rts'));
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

        return view('pages.events.add', compact('rw', 'rts'));
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
        $rw = MRw::find($request->rw);

        $validated = $request->validate([
            'rt' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|string|nullable',
            // 'contact' => 'required|nullable ',
            // 'link_maps' => 'required|string|nullable',
            // 'link_order' => 'required|string|nullable',
            'date' => 'nullable',
            'location' => 'nullable',
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
                'event', // Folder di dalam 'uploads'
                $randomName,
                'public_uploads' // Disk yang sudah didefinisikan
            );

            // Simpan path ke variabel validated
            $validated['image'] = 'uploads/' . $path;
        }

        $newEvent = Event::create([
            'rt_id' => $validated['rt'],
            'rw_id' => $rw->id,
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'description' => $validated['description'],
            // 'contact' => $validated['contact'],
            // 'link_maps' => $validated['link_maps'],
            // 'link_order' => $validated['link_order'],
            'date' => $validated['date'] ?? null,
            'location' => $validated['location'] ?? null,
            'status' => $request->status === "on" ? 1 : 0, // Checkbox menghasilkan boolean
        ]);

        if ($newEvent) {
            return redirect()->route('event.index', ['rw' => $rw->id])->with('success', 'Data Kegiatan berhasil ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $umkm
     * @return \Illuminate\Http\Response
     */
    public function show(Event $umkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $umkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $rt = MRt::find($event->rt_id);
        $rw = MRw::find($rt->rw_id);
        $rts = MRt::where('rw_id', $rw->id)->get();

        return view('pages.events.edit', compact('event', 'rw', 'rts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $umkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $umkm = Event::findOrFail($request->id);
        $rw = MRw::find($umkm->rt->rw->id);

        // dd($rw);

        $validated = $request->validate([
            'rt' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string',
            // 'contact' => 'nullable',
            // 'link_maps' => 'nullable|string',
            // 'link_order' => 'nullable|string',
            'date' => 'nullable',
            'location' => 'nullable',
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
                'event',
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
            // 'contact' => $validated['contact'],
            // 'link_maps' => $validated['link_maps'],
            // 'link_order' => $validated['link_order'],
            'date' => $validated['date'],
            'location' => $validated['location'],
            'status' => $request->status === "on" ? 1 : 0,
        ]);

        return redirect()->route('event.index', ['rw' => $rw->id])->with('success', 'Data Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $umkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $umkm = Event::findOrFail($request->id);
        $rw = MRw::find($umkm->rt->rw->id);
        $umkm->delete();
        return redirect()->route('event.index', ['rw' => $rw->id])->with('success', 'Data Kegiatan berhasil dihapus.');
    }
}
