<?php

namespace App\Http\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'title', 'content', 'review_rating'];

    public function createReview($request, $movieId)
    {
        $userId = Auth::User()->id;
        $rating = $request->get('rating');
        $title = $request->get('title');
        $content = $request->get('content');

        DB::table('reviews')->insert([
            'user_id' => $userId,
            'movie_id' => $movieId,
            'tvshow_id' => null,
            'title' => $title,
            'content' => $content,
            'review_rating' => $rating,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function createTvReview($request, $tvshowId)
    {
        $userId = Auth::User()->id;
        $rating = $request->get('rating');
        $title = $request->get('title');
        $content = $request->get('content');

        DB::table('reviews')->insert([
            'user_id' => $userId,
            'movie_id' => null,
            'tvshow_id' => $tvshowId,
            'title' => $title,
            'content' => $content,
            'review_rating' => $rating,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function getAllReviews($movieId)
    {
        $reviews = DB::table('reviews')->orderBy('updated_at', 'desc')->get()->where('movie_id', $movieId)->where('type', 'approved');
        $authors = [];

        foreach ($reviews as $key => $review) {
            $userId = $reviews[$key]->user_id;
            $author = array_first(DB::table('users')->get()->where('id', $userId));
            $reviews[$key]->author = $author;
        }

        return $reviews;
    }

    public function getAllTvReviews($tvshowId)
    {
        $reviews = DB::table('reviews')->orderBy('updated_at', 'desc')->get()->where('tvshow_id', $tvshowId)->where('type', 'approved');
        $authors = [];

        foreach ($reviews as $key => $review) {
            $userId = $reviews[$key]->user_id;
            $author = array_first(DB::table('users')->get()->where('id', $userId));
            $reviews[$key]->author = $author;
        }

        return $reviews;
    }

    public function getAllReviewsOnHold()
    {
        $reviews = DB::table('reviews')->orderBy('updated_at')->latest()->get()->where('type', 'hold');
        foreach ($reviews as $key => $review) {
            $userId = $reviews[$key]->user_id;
            $author = array_first(DB::table('users')->get()->where('id', $userId));
            $reviews[$key]->author = $author;
        }

        return $reviews;
    }

    public function removeReview($reviewId)
    {
        DB::table('reviews')->where('id', $reviewId)->delete();
    }

    public function approveReview($reviewId)
    {
        DB::table('reviews')->where('id', $reviewId)->update(['type' => 'approved']);
    }

    public function author()
    {
        return $this->belongsTo('App\Http\Models\User', 'id');
    }
}
