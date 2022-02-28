<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadFile extends Controller
{
    //
    public function downloadFile($file_name)
    {
        # code...
            $file=Storage::get("officialdocs/".$file_name);
// dd($file);
            return (new Response($file, 200))
               ->header('Content-Type', 'file');

    } public function downloadFileStudent($file_name)
    {
        # code...
            $file=Storage::get("studentdocs/".$file_name);
// dd($file);
            return (new Response($file, 200))
               ->header('Content-Type', 'file');

    }
}
