<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Review;

class ReviewController extends Controller
{
    public function addReview(Request $request, $movieId) 
    {
        $reviewModel = new Review();
        $reviewModel->createReview($request, $movieId);
        return redirect()->back();
    }

    public function addTvReview(Request $request, $tvshowId)
    {
        $reviewModel = new Review();
        $reviewModel->createTvReview($request, $tvshowId);
        return redirect()->back();
    }

    public function removeReview($reviewId) 
    {
        $reviewModel = new Review();
        $reviewModel->removeReview($reviewId);
        return redirect()->back();
    }
}
