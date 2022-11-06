<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (!function_exists('str')) {
    function str()
    {
        return new \Illuminate\Support\Str;
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path)
    {
        $url = Storage::url($path);
        if (str()->startsWith($url, 'http')) {
            return $url;
        }
        return url($url);
    }
}

function str_slug($string)
{
    $now = now();
    $string = str()->slug($string);
    return "{$now->year}-{$string}-{$now->month}-{$now->day}-{$now->hour}";
}

function userHasRole(string $role_name, int $code = 403, ?string $message = null)
{
    if (Auth::user()->role->name != $role_name) {
        abort($code, $message);
    }
}

function makeSlugModel(string $string, $model, $column = 'slug')
{
    $slug = str()->slug($string);
    $data = $model::where($column, $slug)->first();
    if ($data) {
        $count = $model::where($column, 'like', "{$slug}%")->count();
        $count = $count + 1;
        $slug = "{$slug}-{$count}";
    }
    return $slug;
}