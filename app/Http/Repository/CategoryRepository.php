<?php

namespace App\Http\Repository;
use App\category;
use Mockery\CountValidator\Exception;

interface ICategoryRepository extends IRepositoryBase {

}

class CategoryRepository implements ICategoryRepository {

    public function all($take = null, $skip = null) {
        $categories = category::where('id','<>', 0)->orderBy('Name');

        if($skip != null && $skip > 0) {
            $categories = $categories->skip($skip);
        }

        if($take != null && $take > 0) {
            $categories = $categories->take($take);
        }

        $categories = $categories->get();
        $cates = array();
        $i = -1;
        foreach($categories as $category) {
            $i++;
            $cates[$i] = new category();
            $cates[$i]->id = $category['id'];
            $cates[$i]->Name = $category['Name'];
        }
        return $cates;
    }
    
    public function singleId($id) {
        $category = category::find($id);
        if($category != null) {
            $cate = new category();
            $cate->id = $category['id'];
            $cate->Name = $category['Name'];
            return $cate;
        }
        return null;
    }

    public function create($obj) {
        $obj->id = category::insertGetId([
            'Name' => $obj->Name
        ]);
    }

    public function update($obj) {
        $category = category::find($obj->id);
        $category['Name'] = $obj->Name;
        $category->save();
    }
    
    function delete($obj) {
        throw new Exception("Chức năng này hiện không có.");
    }
}