<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadsController extends Controller
{
    public function index()
    {
        $images = ImageUpload::latest()->get();

        return view('welcome', compact('images'));
    }

    public function store()
    {
        $path = public_path('images');

        if (!is_dir($path)) {
            mkdir($path);
        }

        $collection = Collection::wrap(request()->file('file'));

        $collection->each(function (UploadedFile $image) use ($path) {
            $suffix    = Str::random();
            $original  = "{$suffix}.{$image->getClientOriginalExtension()}";
            $thumbnail = "{$suffix}_thumb.{$image->getClientOriginalExtension()}";

            Image::make($image)->fit(250, 250)->save($path . '/' . $thumbnail);

            $image->move($path, $original);

            ImageUpload::create([
                'original' =>  'images/' . $original,
                'thumbnail' => 'images/' . $thumbnail
            ]);
        });
    }

    public function destroy(ImageUpload $imageUpload)
    {
        File::delete([
            public_path($imageUpload->original),
            public_path($imageUpload->thumbnail)
        ]);

        $imageUpload->delete();

        return redirect('/');
    }
}
