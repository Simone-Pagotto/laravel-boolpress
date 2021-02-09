<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsInformation = factory(App\PostInformation::class,100)->create();

        foreach($postsInformation as $postInformation){
            //devo richiamare il post_id di post informatio e usarlo per cercare il titolo
            //su la factory post
            $postId = $postInformation->post_id;
            $slugTitlePost = DB::table('posts')->where('id',$postId)->value('title');
            
            $postInformation->slug = Str::of($slugTitlePost)->slug('-');
            $postInformation->save();
        }
    }
}
