<?php

use App\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $movies = [
            [
                'name' => 'Fantastic Beasts: The Crimes of Grindelwald'
            ],
            [
                'name' => 'The Ballad of Buster Scruggs'
            ],
            [
                'name' => 'Bohemian Rhapsody'
            ],
            [
                'name' => 'Creed II'
            ],
            [
                'name' => 'The Lion King'
            ],
            [
                'name' => 'Ralph Breaks the Internet'
            ],
            [
                'name' => 'Robin Hood'
            ],
            [
                'name' => 'Widows'
            ],
            [
                'name' => 'A Star Is Born'
            ],
            [
                'name' => 'Aquaman'
            ],
            [
                'name' => 'Grinch'
            ],
            [
                'name' => 'Outlaw King'
            ],
            [
                'name' => 'Fantastic Beasts and Where to Find Them'
            ],
            [
                'name' => 'The Christmas Chronicles'
            ]
        ];

        Movie::insert($movies);

        Movie::all()->each(function ($movie) {

            $grades = array();

            $n = random_int(1, 20);

            for ($i = 0; $i < $n; $i++) {
                array_push($grades, ["grade" => random_int(1, 10)]);
            }

            $movie->reviews()->createMany($grades);

        });
    }
}
