<?php

namespace App\Http\Controllers;

use App\Models\EtalaseBook;
use App\Models\EtalaseGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtalaseBookController extends Controller
{
    /**
     * Request API
     */
    public function index()
    {
        $etalases = EtalaseBook::with('group')->withCount('books')->get();
        $groups = EtalaseGroup::withCount('etalase')->get();

        return view('etalase.index', compact('etalases', 'groups'));
    }

    public function store_group(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if ($request->group_id) {
            $group = EtalaseGroup::find($request->group_id);
            $group->name = $request->name;
            $group->slug = makeSlugModel($request->name, EtalaseGroup::class);
            $group->save();
        } else {
            EtalaseGroup::create([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'slug' => makeSlugModel($request->name, EtalaseGroup::class)
            ]);
        }


        if ($request->ajax()) {
            return view('etalase.tbody-group', [
                'groups' => EtalaseGroup::withCount('etalase')->get()
            ]);
        }

        return redirect()->back()->with('success', 'Etalase Group berhasil ditambahkan');
    }

    public function delete_group(EtalaseGroup $etalaseGroup)
    {
        $etalaseGroup->delete();
        if (request()->ajax()) {
            return view('etalase.tbody-group', [
                'groups' => EtalaseGroup::withCount('etalase')->get()
            ]);
        }
        return redirect()->back()->with('success', 'Etalase Group berhasil dihapus');
    }

}
