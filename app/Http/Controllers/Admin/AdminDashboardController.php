<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use App\Models\Review;
use App\Models\Genre; 

class AdminDashboardController extends Controller
{
    public function index()
    {
        $movieCount = Movie::count();
        $userCount = User::where('role', '!=', 'admin')->count();
        $reviewCount = Review::count();
        $genreCount = Movie::distinct('genre')->count('genre');

        return view('admin.dashboard', compact('movieCount', 'userCount', 'reviewCount', 'genreCount'));
    }
}
