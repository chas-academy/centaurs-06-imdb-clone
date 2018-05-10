<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Review;

class ReviewController extends Controller
{
    public function addReview(Request $request, $movieId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content'  => 'required|string|max:255',
            'rating' => 'required|numeric|between:0,5'
        ]);

        if ($validator->fails()) {
            return redirect("movie/{$movieId}")
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $userId = Auth::User()->id;
            $rating = $request->get('rating');
            $title = $request->get('title');
            $content = $request->get('content');

            $review = Review::create([
                'user_id' => $userId,
                'movie_id' => $movieId,
                'tvshow_id' => null,
                'title' => $title,
                'content' => $content,
                'review_rating' => $rating
            ]);

            $review->save();
        }

        return redirect()->back()->with('message', 'Review successfully added');
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

    public function getReviewsOnHold()
    {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAllReviewsOnHold();


        return view('pages.manage-reviews')->with('reviews', $reviews);
    }

    public function approveReview($reviewId)
    {
        $reviewModel = new Review();
        $reviewModel->approveReview($reviewId);

        return redirect()->back();
    }
}
