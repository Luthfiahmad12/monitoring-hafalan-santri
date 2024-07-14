<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
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
        $DaftarSurah = $this->paginate($this->surah);
        return view('surah.index', compact('DaftarSurah'));
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginatedItems = new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );

        // Set the path for pagination links
        $paginatedItems->setPath(request()->url());

        return $paginatedItems;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nomor)
    {
        $json = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('http://equran.id/api/v2/surat/' . $nomor)->json();
        $detailSurah = $json['data'];
        // dd($detailSurah);
        // return view('surah.show');

        return view('surah.show', compact('detailSurah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surah $surah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Surah $surah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surah $surah)
    {
        //
    }
}
