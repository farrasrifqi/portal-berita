<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        try {
            $slider = Slider::latest()->paginate('10');

            if ($slider) {
                return ResponseFormatter::success($slider, 'Data slider berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data slider tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function create(Request $request)
    {
        try {
            //validate the request
            $this->validate($request, [
                'url' => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            //upload the image
            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

            //save to DB
        $slider = Slider::create([
            'url'   => $request->url,
            'image'  => $image->hashName()
        ]);

        if($slider){
            return ResponseFormatter::success($slider, 'Data Slider Berhasil Diambil');
        } else {
            return ResponseFormatter::error(null, 'Data Slider Tidak Ada', 404);
        }

        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data' => null,
                'message' => 'Data gagal ditambahkan',
                'error' => $error
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            // delete image
            Storage::disk('local')->delete('public/categories/' . basename($slider->image));
            // delete data
            $slider->delete();

            if ($slider) {
                return ResponseFormatter::success($slider, 'Data slider berhasil dihapus');
            } else {
                return ResponseFormatter::error(null, 'Data slider tidak ada', 404);
            }
            
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message'   => 'Data gagal dihapus',
                'error'     => $error
            ]);
        }
    }
}
