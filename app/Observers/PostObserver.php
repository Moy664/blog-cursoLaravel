<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    //updated (se activa cuando se llamo al metodo update)
    //updating (se activa cuando se llama al metodo updating)
    public function updating(Post $post){
        if($post->is_published && !$post->published_at){
            $post->published_at = now();
        }
    }
}
