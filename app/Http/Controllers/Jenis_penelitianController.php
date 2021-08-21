<?php

namespace App\Http\Controllers;

use App\Models\Jenis_penelitian;
use Illuminate\Http\Request;

class Jenis_penelitianController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Jenis_penelitian::class);

        $data = Jenis_penelitian::all();
        return view('master.jenis_penelitian', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Jenis_penelitian::class);

        return view('master.jenis_penelitian-add');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Jenis_penelitian::class);

        $this->validate($request, [
            'name_jns_penelitian'   => 'required',
        ]);

        $data = Jenis_penelitian::create([
            'name_jns_penelitian'   => $request->name_jns_penelitian,
        ]);

        if ($data) {
            return redirect()->route('jenis_penelitian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Jenis_penelitian $jenis_penelitian)
    {
        $this->authorize('update', Jenis_penelitian::class);

        return view('master.jenis_penelitian-edit', compact('jenis_penelitian'));
    }

    public function update(Request $request, Jenis_penelitian $jenis_penelitian)
    {
        $this->authorize('update', User::class);

        $data = Jenis_penelitian::findOrFail($jenis_penelitian->id);

        $data->update([
            'name_jns_penelitian' => $request->name_jns_penelitian,
        ]);

        if ($data) {
            return redirect()->route('jenis_penelitian.index')->with('success', 'Data updated successfully');
        }
    }

    public function destroy(Jenis_penelitian $jenis_penelitian)
    {
        $this->authorize('delete', Jenis_penelitian::class);

        $jenis_penelitian->find($jenis_penelitian->id)->all();

        $jenis_penelitian->delete();

        if ($jenis_penelitian) {
            return redirect()->route('jenis_penelitian.index')->with('success', 'Data berhasil dihapus');
        }
    }
}
