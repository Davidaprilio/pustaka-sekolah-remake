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

    public function kategori_delete(EtalaseBook $etalaseBook)
    {
        $etalaseBook->delete();
        return redirect()->back()->with('cat_success', 'Etalase Group berhasil dihapus');
    }

    public function kategori_store(Request $request)
    {
        $request->validate([
            'name_cat' => 'required',
            'group_id' => 'required'
        ]);
        if ($request->item_id) {
            $item = EtalaseBook::find($request->item_id);
            $item->name = $request->name_cat;
            $item->slug = makeSlugModel($request->name_cat, EtalaseBook::class);
            $item->etalase_group_id = $request->group_id;
            $item->save();
        } else {
            EtalaseBook::create([
                'name' => $request->name_cat,
                'etalase_group_id' => $request->group_id,
                'slug' => makeSlugModel($request->name_cat, EtalaseBook::class),
                'user_id' => Auth::id()
            ]);
        }

        return redirect()->back()->with('cat_success', 'Etalase Group berhasil disimpan');
    }

}
