<?php

namespace App\Http\Controllers;

use App\Models\EtalaseBook;
use Illuminate\Http\Request;

class EtalaseBookController extends Controller
{
    /**
     * Request API
     */
    public function index()
    {
        $etalase = EtalaseBook::all();
        $menu_etalase = [];
        foreach ($etalase as $value) {
            array_push($menu_etalase, [
                'name' => $value->name,
                'slug' => $value->slug,
                'stack' => $value->stack
            ]);
        }
        return $menu_etalase;
    }
}
