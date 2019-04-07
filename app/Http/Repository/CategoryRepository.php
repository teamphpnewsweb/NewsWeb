<?php

namespace App\Http\Repository;
use App\category;
use Mockery\CountValidator\Exception;

interface ICategoryRepository extends IRepositoryBase {

}

class CategoryRepository implements ICategoryRepository {
    public function all($take = null, $skip = null) {
        $categories = category::all();

        if($skip != null && $skip > 0) {
            $categories = $categories->skip($skip);
        }

        if($take != null && $take > 0) {
            $categories = $categories->take($take);
        }

        $categories = $categories->toArray();
        $cates = array();
        $i = -1;
        foreach($categories as $category) {
            $i++;
            $cates[$i] = new Model\Category();
            $cates[$i]->id = $category->id;
            $cates[$i]->FullName = $category->FullName;
            $cates[$i]->Email = $category->Email;
            $cates[$i]->Password = $category->Password;
        }
        return cates;
    }
    
    public function singleId($id) {
        $category = category::find($id);
        $cate = new Model\Category();
        $cate->id = $category->id;
        $cate->FullName = $category->FullName;
        $cate->Email = $category->Email;
        $cate->Password = $category->Password;
        return $cate;
    }

    public function create($obj) {
        $obj->id = category::insertGetId([
            'FullName' => $obj->FullName,
            'Email' => $obj->Email,
            'Password' => $obj->Password
        ]);
    }

    public function update($obj) {
        $category = category::find($obj->id);
        $category->FullName = $obj->FullName;
        $category->Email = $obj->Email;
        $category->Password = $obj->Password;
        $category->save();
    }
    
    function delete($obj) {
        throw new Exception("Chức năng này hiện không có.");
    }
}