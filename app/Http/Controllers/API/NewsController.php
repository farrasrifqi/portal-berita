<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::latest()->paginate('10');

            if ($news) {
                return ResponseFormatter::success($news, 'Data Berhasil ditampilkan');
            } else {
                return ResponseFormatter::error(null, 'Data gagal ditampilkan', 400);
            }

        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
    
    public function show($id)
    {
        try {
            $news = News::findOrFail($id);

            if ($news) {
                return ResponseFormatter::success($news, 'Data news Berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data news tidak ada', 400);
            }

        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
