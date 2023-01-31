<?php

namespace App\Http\Controllers;

use App\Models\ReadSession;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $most_frequently_read_user = ReadSession::with('user')->orderBy('on_reading', 'DESC')->orderBy('updated_at', 'DESC')->take(20)->get();

        return view('activity.index', [
            'most_frequently_read_user' => $most_frequently_read_user,
        ]);
    }
}
