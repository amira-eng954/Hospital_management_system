<?php
namespace App\Services;
use GuzzleHttp\Client;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class Upload
{


    public function upload($file,$folder,$user)
    {
        $image=uniqid().'.'.$file->getClientOriginalExtension();
        
        //Image::create
        $user->image()->create([
            'image_name'=>$image
        ]);


        return $file->storeAs($folder,$image,'public');

    }



    public function delete($folder,$file)
    {
           Storage::disk('public')->delete($folder.'/'.$file);
    }
    
} 


