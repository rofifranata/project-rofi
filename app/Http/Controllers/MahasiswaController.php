<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }
    public function create()
    {
        return view('mahasiswa.create');
    }
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswas',
            'alamat' => 'required',
            // Add other validation rules for other fields
        ]);
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index');
    }
    // public function show(Mahasiswa $mahasiswa)
    // {
    //     return view('mahasiswa.show', compact('mahasiswa'));
    // }
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'email' => ['required', 'email', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'alamat' => 'required',
            // Add other validation rules for other fields
        ]);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index');
    }
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index');
    }
}
