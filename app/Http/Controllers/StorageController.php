<?php

namespace App\Http\Controllers;

use App\ListingImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StorageController extends Controller
{
    public function upload(Request $request){
        if($request->hasFile('file')){
            $listing_image = new ListingImages();
            $listing_image->listing_id = $request->listing_id;
            $listing_image->image_uri = $this->saveFile($request->file('file'), $request->listing_id);
            $listing_image->save();
        }
    }

    private function saveFile($file,$id){
        $path = Storage::disk('public')->putFileAs(
            'listings', $file, str_random(10).'-'.$id .'.'.$file->getClientOriginalExtension()
        );
        return $path;
    }

    public function getImage($category, $file){
        $img = Image::make(Storage::disk('public')->get($category.'/'.$file))->resize(150, 150);

        return $img->response('jpg');
    }

    public function deleteImage(Request $request){
        $images = $request->images;
        foreach($images as $id){
            $listing_image = ListingImages::find($id);
            if(Storage::disk('public')->delete($listing_image->image_uri)){
                $listing_image->delete();
            }
        }
        return response()->json([
            'deleted'   =>  true
        ]);

    }
}
