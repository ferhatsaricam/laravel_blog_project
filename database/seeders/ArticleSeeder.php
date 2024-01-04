<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<4; $i++)
        {
            $faker=Faker::create();
            $title=$faker->sentence(4);
            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$title,
                'image'=>$faker->imageUrl(800,400,'cats',true,'Blog Sitesi'),
                'content'=>$faker->paragraph(5),
                'slug'=>Str::slug($title),
                'created_at'=>$faker->dateTimeThisDecade($max='now'),
                'updated_at'=>now()
                
            ]);

        }
    }
}
