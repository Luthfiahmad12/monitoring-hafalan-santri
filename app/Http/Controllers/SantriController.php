<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    public function index()
    {
        $santris = Santri::all();
        $users = User::role('ustadz')->get();
        return view('santri.index', compact('santris', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('santri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'kelas' => ['required', 'string'],
            'password' => ['required', 'min:8'],
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'numeric' => ':attribute harus berupa angka',
        ]);
        // dd($validatedData);

        try {
            $santri = Santri::create([
                'name' => $validatedData['name'],
                'kelas' => $validatedData['kelas'],
                'alamat' => $validatedData['alamat'],
                'no_telp' => $validatedData['no_telp'],
            ]);

            // Buat user baru jika santri berhasil dibuat
            if ($santri) {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                ]);
                $user->assignRole('santri');
            }
            return redirect()->route('santri.index')->with('success', 'Data santri berhasil ditambahkan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'kelas' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'unique:santris,no_telp,' . $id],
        ]);

        $santri = Santri::find($id);
        if ($santri) {
            User::where('name', $santri->name)->first()->update([
                'name' => $validated['name'],
            ]);
        }
        $santri->update($validated);
        return back()->with('success', 'Data santri berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santri = Santri::find($id);
        if ($santri) {
            User::where('name', $santri->name)->first()->delete();
        }
        $santri->delete();
        return back()->with('success', 'Data santri berhasil dihapus');
    }

    public function addUstadz(Request $request)
    {
        $validated = $request->validateWithBag('CreateData', [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        $user->assignRole('ustadz');

        return back()->with('success', 'Data ustadz berhasil ditambahkan');
    }

    public function updateUstadz(string $id, Request $request)
    {
        $validated = $request->validateWithBag('updateData', [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $id],
            'password' => ['nullable', 'min:8'],
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
        ]);

        $user = User::find($id);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return back()->with('success', 'Data ustadz berhasil diubah');
    }

    public function destroyUstadz(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return back()->with('success', 'Data ustadz berhasil dihapus');
    }
}
