<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Book::query()->orderBy('title')->get())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    public function comments(): JsonResponse
    {
        return response()->json(
            ContactMessage::query()
                ->where('status', 'approved')
                ->latest()
                ->get(['name', 'message', 'created_at'])
        )->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}