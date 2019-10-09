<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;



/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{
    /**
     * Получить модель для редактирования в админке.
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit ($id)
    {
        return $this->startConditions()->find($id);
    }
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список категорий для вывода в выпадающем списке
     * @return Collection
     */
    public function getForComboBox()
    {

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Получить категории для вывода пагинатором
     * @param int/null $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
       // dd($result);
        return $result;
    }

}
