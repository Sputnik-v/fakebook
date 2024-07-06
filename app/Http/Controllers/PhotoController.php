<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(StorePhotoRequest $request)
    {
        if ($request->hasFile('image'))
        {

            $originalName = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "user-images/".$filename."_".time().".".$extension;


            $path = $request->file('image')->storeAs('public', $fileNameToStore);

            $pathForDatabaseSave = env('APP_DOMAIN') . 'storage/' . $fileNameToStore;
            $userId = $request->user()->id;

            $photo = Photo::query()->updateOrCreate([
                'image' => $pathForDatabaseSave,
            ], [
               'image' => $pathForDatabaseSave,
                'active_image' => true,
                'user_id' => $userId,
            ]);

            if ($photo)
            {
                return redirect()->route('dashboard');
            } else
            {
                return back()->withErrors(['message'=>'Failed to save']);
            }
        }
    }
}
