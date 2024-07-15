<?php

namespace App\Http\Controllers;

use App\Models\Hafalan;
use App\Models\Santri;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HafalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $surah = [];

    public function __construct()
    {
        $this->surah = Cache::remember('surah_list', 60, function () {
            $json = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get('http://equran.id/api/v2/surat')->json();
            return $json['data'];
        });
    }

    public function index()
    {
        $hafalans = Hafalan::with('santri', 'surah')->get();
        $santris = Santri::all();
        $daftarSurah = $this->surah;
        return view('hafalan.index', compact('hafalans', 'santris', 'daftarSurah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => ['required'],
            'nama_surah' => ['required'],
        ], [
            'santri_id.required' => 'Pilih Santri terlebih dahulu',
            'nama_surah.required' => 'Pilih Surah terlebih dahulu',
        ]);

        $surah = Surah::updateOrCreate(
            ['nama_surah' => $validated['nama_surah']], // Kriteria pencarian
            [] // Data untuk disimpan atau di-update jika ditemukan
        );

        $check = Hafalan::where('santri_id', $validated['santri_id'])
            ->where('surah_id', $surah->id)->first();

        if ($check) {
            return back()->with('warning', 'Hafalan sudah ditambahkan!!');
        } else {
            Hafalan::create([
                'santri_id' => $validated['santri_id'],
                'surah_id' => $surah->id,
            ]);
            return back()->with('success', 'Hafalan Berhasil Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hafalan $hafalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hafalan $hafalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hafalan = Hafalan::with('comments.user')->find($id);
        $hafalan->update([
            'status' => $request->status ?? false,
            'penilaian' => $request->penilaian ?? null,
        ]);
        $hafalan->comments()->create([
            // 'hafalan_id' => $hafalan->id, //otomatis terambil
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Berhasil Menambah Catatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hafalan = Hafalan::find($id);
        $hafalan->delete();
        return back()->with('success', 'Hafalan Berhasilt Dihapus');
    }
}
