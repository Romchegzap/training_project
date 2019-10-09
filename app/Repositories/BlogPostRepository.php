<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;


/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 */

class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список статей для вывода списком(админка)
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                //1st way
                'category' => function($query){
                    $query->select(['id', 'title']);
                },
                //2nd way
                'user:id,name'
            ])
            ->paginate(25);
        return $result;
    }
}





