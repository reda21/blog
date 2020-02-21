<?php
namespace App\Repositories;

class PostRepository extends BaseRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return \App\Models\Post::class;
    }

}
