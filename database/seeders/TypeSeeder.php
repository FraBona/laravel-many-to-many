<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Informatica', 'Scienza', 'Storia', 'Medicina'];

        foreach($types as $type){
            $new_type = new Type();

            $new_type->name = $type;
            $new_type->slug = Str::slug($type);

            $new_type->save();
        }
    }
}
