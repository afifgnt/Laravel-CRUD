<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa as Model;

class TabelController extends Controller
{
    private $viewIndex ='siswa_index';
    private $viewCreate = 'siswa_form';
    private $viewEdit = 'siswa_form';
    private $viewShow = 'siswa_show';
    private $routePrefix = 'siswa';

    public function index()
    {
        return view('siswa.' . $this->viewIndex, [
            'models' => Model::latest()->paginate(50),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Siswa',
        ]);
    }

    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA SISWA'
        ];
        return view('siswa.' . $this->viewCreate, $data);
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nisn' => 'required',
            'kelas' => 'required',
        ], [
            'name.required' => 'Kolom Nama Harus Diisi.',
            'alamat.required' => 'Kolom Alamat Harus Diisi.',
            'nisn.required' => 'Kolom NISN Harus Diisi.',
            'kelas.required' => 'Kolom Kelas Harus Diisi.',
        ]);
        
        Model::create($requestData);
        return redirect()->route($this->routePrefix . '.index')->with('success', 'Data berhasil disimpan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'FORM DATA SISWA'
        ];
        return view('siswa.' . $this->viewEdit, $data);
    }

    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nisn' => 'required',
            'kelas' => 'nullable',
        ], [
            'name.required' => 'Kolom Nama Harus Diisi.',
            'alamat.required' => 'Kolom Alamat Harus Diisi.',
            'nisn.required' => 'Kolom NISN Harus Diisi.',
        ]);
                  
        $model = Model::findOrFail($id);
        $model->fill($requestData);
        $model->save();
        
        return redirect()->route($this->routePrefix . '.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $model = Model::findOrFail($id);
        $model->delete();
        return redirect()->route($this->routePrefix . '.index')->with('success', 'Data berhasil dihapus');
    }
}
