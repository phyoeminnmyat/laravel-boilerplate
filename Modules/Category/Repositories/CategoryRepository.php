<?php

namespace Modules\Category\Repositories;

use Modules\Category\Entities\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'created_at', $sort = 'desc')
    {
        return $this->model
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model
            ->select('*');
    }

    public function create(array $input)
    {
        DB::transaction(function()use ($input)
        {
            $category = $this->model;
            $category->name = $input['name'];
            $category->email = $input['email'];
            if($input['description']){
            $category->description = $input['description'];
            }else{
            $category->description = '';
            }    
            if(isset($input['logo'])){
            $name = uniqid('category-').'.'.$input['logo']->extension();
            $category->logo = $input['logo']->storeAs('/category' , $name, 'public');
            }else{
            $category->logo = '';    
            }
            $category->status = isset($input['status']) ? 1 : 0 ;
            if ($category->save()){
            return true;
            }
            throw new GeneralException(trans('offer::exceptions.backend.offer.create_error'));

        });
    }

    public function update($category,array $input)
    {
        if(isset($input['logo'])){
        // \Storage::delete(substr($category->logo, 9));
        $name = uniqid('category - ').'.'.$input['logo']->extension();
        $logo = $input['logo']->storeAs('/category' , $name, 'public');
        }else{
            $logo = $category->logo;
        }
        
        $status = isset($input['status']) ? 1 : 0 ;
        $catname = $input['name'];
        $catemail = $input['email'];
        $description = isset($input['description'])? $input['description'] : '';
        Category::find($category->id)->update([
            'name'          => $catname ,
            'email'          => $catemail ,
            'description'   => $description ,
            'status'        => $status ,
            'logo'          => $logo

            ]);
            return true;
    }
}
