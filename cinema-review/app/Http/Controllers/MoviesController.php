<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\Jobs\PostReview;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function getMovies() {

        $movies = Movie::join('reviews', 'reviews.movie_id', '=', 'movies.id')
            ->groupBy(['movies.id', 'movies.name'])
            ->select([DB::raw( 'round( AVG(reviews.grade), 2) grade' ), 'movies.name', 'movies.id'])
            ->get();

            //->get(['movies.*']); !!!!!!!!!

        /*
            $movies = DB::table('movies')
            ->join('reviews', 'reviews.movie_id', '=', 'movies.id')
            ->groupBy('movies.id')
            ->select(DB::raw( 'AVG(reviews.grade) grade' ))
            ->get();
         */

/*        foreach($movies as &$movie) {
            $reviews = $movie->reviews;

            $avg_grade = 0;

            foreach($reviews as $review) {
                $avg_grade = $avg_grade + $review->grade;
            }

            $avg_grade = $avg_grade/count($reviews);

            $movie->grade = round($avg_grade,2 );

        };*/

        return view("movies", ["movies" => $movies]);
    }

    public function postReview(Request $request) {

        $movie = Movie::find($request->movie_id);

        $this->dispatch(new PostReview($movie, $request->grade));

    }
}
