<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages=['Hakkımızda', 'Kariyer', 'Vizyon', 'Misyon'];
        $count =0;

        foreach($pages as $page){
            $count++; 
            DB::table('pages')->insert([
                'title'=> $page,
                'slug'=>Str::slug($page),
                
                'image'=>'https://www.rnetyazilim.com.tr/wp-content/uploads/2023/05/B2B-nedir-3-large.jpg',

                'content'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, expedita harum? Dignissimos, porro nemo expedita perferendis non totam? Labore officia quaerat numquam tempora, blanditiis neque veniam dolorum alias. Velit sed dolores voluptates aliquid odio! Culpa consequatur, rem neque perspiciatis expedita, minus voluptates mollitia sapiente distinctio beatae quas cumque fugit nostrum!',

                'order'=>$count,

                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
