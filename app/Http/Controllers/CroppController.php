<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CroppController extends Controller
{
    public function index()
    {
        return view('crop');
    }

    function crop(Request $request)
    {
        $path = 'files/';
        $file = $request->file('file');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {
            return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }
}
