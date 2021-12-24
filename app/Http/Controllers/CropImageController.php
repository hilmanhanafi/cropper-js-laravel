<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use Image;

class CropImageController extends Controller
{

    public function index()
    {
        return view('crop-image-upload');
    }


    public function uploadCropImage(Request $request)
    {

        // dd($request->all());
        $isi = $request->all();

        // dd($horee);


        foreach ($isi['horee'] as $key => $value) {
            /* Cek apakah value nyo tido sama dengan null  */
            if ($value != '') {
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));

                /* Compress Image  */
                $img = Image::make($info)->resize(200, 200);

                /* Set name unique */
                $imageName = uniqid() . '.png';

                /* Save to folder image */
                $img->save('images/' . $imageName);
            }
        }

        return response()->json(['success' => 'Crop Image Uploaded Successfully']);


        // for ($i = 0; $i < count($isi['horee']); $i++) {
        //     if ($isi['horee'][$i] != "") {

        //         $info[$i] = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $isi['horee'][$i]));

        //         dd($isi['horee'][$i]);
        //         // dd($info[$i]);
        //         /* Compress Image  */
        //         $img = Image::make($info[$i])->resize(200, 200);

        //         /* Set name unique */
        //         $imageName = uniqid() . '.png';

        //         /* Save to folder image */
        //         $img->save('images/' . $imageName);
        //     }

        //     return response()->json(['success' => 'Crop Image Uploaded Successfully']);
        // }
    }

    // public function uploadCropImage(Request $request)
    // {

    //     // dd($request->all());

    //     $horee = $request->horee;
    //     $folderPath = public_path('thumbnails/');

    //     $data = array();
    //     for ($i = 0; $i < count($horee); $i++) {

    //         $image_parts = explode(";base64,", $horee[$i]);

    //         dd($image_parts);


    //         foreach ($image_parts as $key => $value) {

    //             dd($value);
    //             // array_push($data, $value);
    //         }

    //         $image_base64 = base64_decode($data[1][$i]);


    //         $image_type_aux = explode("image/", $data[0][$i]);
    //         $image_type = $image_type_aux[1][$i];

    //         $imageName = uniqid() . '.png';

    //         $imageFullPath = $folderPath . $imageName;

    //         file_put_contents($imageFullPath, $image_base64);

    //         $saveFile = new Picture;
    //         $saveFile->name = $imageName;
    //         // $saveFile->save();


    //         // dd($image_parts);
    //     }
    //     return response()->json(['success' => 'Crop Image Uploaded Successfully']);


    //     // $image_parts = explode(";base64,", $request->image);

    // }

    // public function uploadCropImage(Request $request)
    // {

    //     // dd($request->all());
    //     $isi = $request->all();
    //     $folderPath = public_path('thumbnails/');

    //     // for ($i = 0; $i < count($isi['horee']); $i++) {
    //     //     $image_parts = explode(";base64,", $isi['horee'][$i]);


    //     //     $image_type_aux = explode("image/", $image_parts[0]);
    //     //     $image_type = $image_type_aux[0];
    //     //     $image_base64 = base64_decode($image_parts[0]);

    //     //     $imageName = 'as' . uniqid() . '.png';

    //     //     $imageFullPath = $folderPath . $imageName;

    //     //     file_put_contents($imageFullPath, $image_base64);

    //     //     $saveFile = new Picture;
    //     //     $saveFile->name = $imageName;
    //     //     $saveFile->save();
    //     // }
    //     // return response()->json(['success' => 'Crop Image Uploaded Successfully']);

    //     foreach ($request->horee as $key => $img) {
    //         // dd($request->horee);
    //         $image_parts = explode(";base64,", $img);

    //         foreach ($image_parts as $key2 => $value) {

    //         // dd($image_parts);
    //         $image_type_aux = explode("image/", $image_parts[0]);
    //         $image_type = $image_type_aux[1];
    //         $image_base64 = base64_decode($image_parts[1]);

    //         $imageName = uniqid() . '.png';

    //         $imageFullPath = $folderPath . $imageName;

    //         file_put_contents($imageFullPath, $image_base64);

    //         $saveFile = new Picture;
    //         $saveFile->name = $imageName;
    //         $saveFile->save();

    //         return response()->json(['success' => 'Crop Image Uploaded Successfully']);
    //         }

    //     }
    // }
}
