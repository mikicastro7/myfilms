<?php

use Illuminate\Database\Seeder;
use App\Movie;

class moviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->delete();

        $movies = [
            [
                'id' => '1',
                'name' => 'Avenger Infinity War',
                'description' => 'The Avengers must stop Thanos, a mad Titan, and his army from getting their hands on all the infinity stones. However, the mad Titan is prepared to go to any lengths to carry out his insane plan.',
                'price' => '8',
                'image' => 'https://pics.filmaffinity.com/Vengadores_Endgame-135478227-large.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=6ZfuNTqbHE8',
                'category_id' => '1'
            ],
            [
                'id' => '2',
                'name' => 'El Joker',
                'description' => "Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Arthur wears two masks -- the one he paints for his day job as a clown, and the guise he projects in a futile attempt to feel like he's part of the world around him. Isolated, bullied and disregarded by society, Fleck begins a slow descent into madness as he transforms into the criminal mastermind known as the Joker.",
                'price' => '8',
                'image' => 'https://1.bp.blogspot.com/-eiPlA2MRTDs/XStQL5kJMMI/AAAAAAAAU7c/6xVK9IFp4JUQb5kjlGeiGK3NRo-BylaPgCEwYBhgL/s1600/Joker---.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=EIyZqNbZQI8',
                'category_id' => '4'
            ],
            [
                'id' => '3',
                'name' => '12 Strong',
                'description' => "In the wake of the September 11 attacks, Captain Mitch Nelson leads a US Special Forces team into Afghanistan for an extremely dangerous mission. Once there, the soldiers develop an uneasy partnership with the Northern Alliance to take down the Taliban and its al-Qaida allies. Outgunned and outnumbered, Nelson and his forces face overwhelming odds in a fight against a ruthless enemy that takes no prisoners.",
                'price' => '4',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/71g3I5WCClL._SY445_.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=-Denciie5oA',
                'category_id' => '1'
            ],
            [
                'id' => '4',
                'name' => 'Deadpool 2',
                'description' => "Deadpool protects a young mutant Russell from the authorities and gets thrown in prison. However, he escapes and forms a team of mutants to prevent a time-travelling mercenary from killing Russell.",
                'price' => '6',
                'image' => 'https://www.covercaratulas.com/ode/mini/carteles-29149.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=20bpjtCbCz0',
                'category_id' => '1'
            ],
            [
                'name' => 'Sorry to Bother You',
                'description' => "In an alternate reality of present-day Oakland, Calif., telemarketer Cassius Green finds himself in a macabre universe after he discovers a magical key that leads to material glory. As Green's career begins to take off, his friends and co-workers organize a protest against corporate oppression. Cassius soon falls under the spell of Steve Lift, a cocaine-snorting CEO who offers him a salary beyond his wildest dreams.",
                'price' => '5',
                'image' => 'https://pics.filmaffinity.com/Sorry_to_Bother_You-346779096-large.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=enH3xA4mYcY',
                'category_id' => '2'
            ],
            [
                'name' => 'Midsommar',
                'description' => "A couple travel to Sweden to visit their friend's rural hometown for its fabled midsummer festival, but what begins as an idyllic retreat quickly devolves into an increasingly violent and bizarre competition at the hands of a pagan cult.",
                'price' => '4',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/47/Midsommar_%282019_film_poster%29.png/220px-Midsommar_%282019_film_poster%29.png',
                'trailer' => 'https://www.youtube.com/watch?v=1Vnghdsjmd0',
                'category_id' => '5'
            ],
            [
                'name' => 'Once Upon a Time In Hollywood',
                'description' => "Actor Rick Dalton gained fame and fortune by starring in a 1950s television Western, but is now struggling to find meaningful work in a Hollywood that he doesn't recognize anymore. He spends most of his time drinking and palling around with Cliff Booth, his easygoing best friend and longtime stunt double. Rick also happens to live next door to Roman Polanski and Sharon Tate -- the filmmaker and budding actress whose futures will forever be altered by members of the Manson Family.",
                'price' => '8',
                'image' => 'https://i.redd.it/t0gm8r3q2hb31.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=ELeMaP8EPAA',
                'category_id' => '2'
            ],
            /*[
                'name' => '',
                'description' => '',
                'price' => '',
                'image' => '',
                'trailer' => ''
                'category_id' => ''
            ],
            [
                'name' => '',
                'description' => '',
                'price' => '',
                'image' => '',
                'category_id'
            ],*/


        ];
        foreach($movies as $movie){
            Movie::create($movie);
        }

    }
}
