<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class CropperController extends Controller
{
    //

    public function uploadImages(Request $request)
    {

        $data = [];

        if ($request->filled('image_data_url')) {
            $imageDataURL = $request->image_data_url;
            $ImageDataURLArray = explode("img_url", $imageDataURL, -1);

            // dd($ImageDataURLArray);
            $images = array();
            foreach ($ImageDataURLArray as $key => $image) {
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . '_post_' . uniqid() . '.jpeg';
                $path = File::put(storage_path('app/public') . '/' . $imageName, base64_decode($image));
                $images[$key] = $imageName;
            }

            $images = implode(",", $images);
            //Comma seprated images in database column
            $data['images'] = $images;
        }


        $image = Image::create($data);

        if ($image) {

            Session::flash('message', 'Images uploaded successfully !');
            Session::flash('alert-class', 'alert-success');
            return view('cropper')->with('data', $image);
            //return redirect()->back()->with(['data' => $image]);
        }

        Session::flash('message', 'Error while uploading images !');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
}
