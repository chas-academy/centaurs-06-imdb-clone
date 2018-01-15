<?php

namespace App\Http\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function createReview($request, $movieId)
    {
        $userId = Auth::User()->id;
        $rating = $request->get('rating');
        $title = $request->get('title');
        $content = $request->get('content');

        DB::table('reviews')->insert([
            'user_id' => $userId,
            'movie_id' => $movieId,
            'episode_id' => null,
            'title' => $title,
            'content' => $content,
            'review_rating' => $rating,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
