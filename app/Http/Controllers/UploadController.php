<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('uploads');
    }

    public function uploads()
    {
        dd(request()->all());
    }
}
