<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {

        function cek1($arg1, $arg2)
        {
            if ($arg2) {
                $arg1['satu'] = 'error 1';
            }
            return $arg1;
        }

        function cek2($arg1, $arg2)
        {
            if ($arg2) {
                $arg1['dua'] = 'error 2';
            }
            return $arg1;
        }

        function cek3($arg1, $arg2)
        {
            if ($arg2) {
                $arg1['tiga'] = 'error 3';
            }
            return $arg1;
        }

        $error = [];

        $error = cek1($error, true);
        $error = cek2($error, true);
        $error = cek3($error, true);

        dd(
            $error
        );
    }
}