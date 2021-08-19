<?php

namespace App\Http\Controllers;

use App\Models\Jenis_pengdiri;
use Illuminate\Http\Request;

class Jenis_pengdiriController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Jenis_pengdiri::class);

        $data = Jenis_pengdiri::all();
        return view('master.jenis_pengdiri', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Jenis_pengdiri::class);

        return view('master.jenis_pengdiri-add');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Jenis_pengdiri::class);

        $this->validate($request, [
            'name_jp'          => 'required',
        ]);

        $data = Jenis_pengdiri::create([
            'name_jp'          => $request->name_jp,
        ]);

        if ($data) {
            return redirect()->route('jenis_pengdiri.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Jenis_pengdiri $jenis_pengdiri)
    {
        $this->authorize('update', Jenis_pengdiri::class);

        return view('master.jenis_pengdiri-edit', compact('jenis_pengdiri'));
    }

    public function update(Request $request, Jenis_pengdiri $jenis_pengdiri)
    {
        $this->authorize('update', User::class);

        $data = Jenis_pengdiri::findOrFail($jenis_pengdiri->id);

        $data->update([
            'name_jp' => $request->name_jp,
        ]);

        if ($data) {
            return redirect()->route('jenis_pengdiri.index')->with('success', 'Data updated successfully');
        }
    }

    public function destroy(Jenis_pengdiri $jenis_pengdiri)
    {
        $this->authorize('delete', Jenis_pengdiri::class);

        $jenis_pengdiri->find($jenis_pengdiri->id)->all();

        $jenis_pengdiri->delete();

        if ($jenis_pengdiri) {
            return redirect()->route('jenis_pengdiri.index')->with('success', 'Data berhasil dihapus');
        }
    }
}
