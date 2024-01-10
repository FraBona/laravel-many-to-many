<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['frontend','backend','chirurgo','insegnante','astronomo','biologo','sistemista'];

        foreach($technologies as $technology_name){
            $technology = new Technology();
            $technology->name = $technology_name;
            $technology->slug = Str::slug($technology_name);

            $technology->save();
        }
    }
}
