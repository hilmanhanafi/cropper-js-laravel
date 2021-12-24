<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Image;

class FileController extends Controller
{
    /**
     * Init view.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Image resize
     */
    public function imgResize(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $image = $request->file('imgFile');
        $input['imagename'] = time() . '.' . $image->extension();

        $filePath = public_path('/thumbnails');

        $img = Image::make($image->path());

        $img->resize(330, 330, function ($const) {
            $const->aspectRatio();
        })->save($filePath . '/' . $input['imagename']);

        $filePath = public_path('/images');
        $image->move($filePath, $input['imagename']);

        return back()
            ->with('success', 'Image uploaded')
            ->with('fileName', $input['imagename']);
    }
}
