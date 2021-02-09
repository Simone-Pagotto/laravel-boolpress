<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(App\Category::class,20)->create()->each(
            function($category){
                $category->save();
            }
        );
    }
}
