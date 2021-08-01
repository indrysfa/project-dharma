<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $data = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('master.dosen-index', compact('data'));
    }

    public function add()
    {
        $this->authorize('create', Dosen::class);

        $data = Periode::all();
        return view('master.dosen-add', compact('data'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Dosen::class);

        $this->validate($request, [
            'name'     => ['required', 'string', 'max:30'],
            'user_id'  => ['required', 'string', 'max:8', 'unique:dosens', 'alpha_dash'],
        ]);

        $data = Dosen::create([
            'user_id'   => $request->user_id,
            'status'    => 'aktif',
            'name'      => $request->name,
        ]);

        if ($data) {
            return redirect()->route('dosen.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Dosen $dosen)
    {
        $data = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('username', '=', $dosen->user_id)
            ->get();
            // dd($data);
        return view('master.dosen-edit', compact('data'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $dosen  = Dosen::findOrFail($dosen->id);

        $dosen->update([
            'status'    => $request->status,
        ]);

        if ($dosen) {
            return redirect()->route('dosen.index')->with('success', 'Data ' . $dosen["name"] . ' Updated successfully');
        }
    }

    public function destroy(Dosen $dos)
    {

        // $users = $dosen->user_id;
        // dd($users);
        // $dosens = User::where('username', $user->username)->get();
        $data = User::join('dosens', 'users.username', '=', $dos->user_id)->get();
        foreach ($data as $dosen) {
            DB::table('dosens')->where('user_id', $dosen->username)->delete();
            DB::table('users')->where('username', $dosen->user_id)->delete();
        }

        // $dosen->delete();

        if ($dosen) {
            return redirect()->route('dosen.index')->with('success', 'Data ' . $dosen["name"] . ' deleted successfully');
        }
    }
}
