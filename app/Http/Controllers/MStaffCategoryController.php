<?php

namespace App\Http\Controllers;

use App\Models\MStaffCategory;
use Illuminate\Http\Request;

class MStaffCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mStaffCategories = MStaffCategory::all();
        return view('pages.m_staff_category.index', compact('mStaffCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.m_staff_category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        try {
            // Simpan data ke database
            MStaffCategory::create([
                'name' => $validatedData['name'],
                'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('staff-category.index')->with('success', 'Kategori Jabatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kegagalan
            return redirect()->back()->with('error', 'Gagal menyimpan data Kategori Jabatan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MStaffCategory  $mStaffCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MStaffCategory $mStaffCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MStaffCategory  $mStaffCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $mStaffCategory = MStaffCategory::find($request->id);
        return view('pages.m_staff_category.edit', compact('mStaffCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MStaffCategory  $mStaffCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $mStaffCategory = MStaffCategory::find($request->id);
        $mStaffCategory->update([
            'name' => $request->name,
            'status' => $request->has('status') ? true : false, // Checkbox menghasilkan boolean
        ]);

        return redirect()->route('staff-category.index')->with('success', 'Data Kategori Jabatan berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MStaffCategory  $mStaffCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mStaffCategory = MStaffCategory::find($request->id);
        $mStaffCategory->delete();
        return redirect()->route('staff-category.index')->with('success', 'Data Kategori Jabatan berhasil dihapus.');
    }
}
