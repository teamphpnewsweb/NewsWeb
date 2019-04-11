<?php

namespace App\Http\Business;

use App\Http\Repository\CategoryRepository;

interface ICategoryBusiness extends IBusinessBase {

}

class CategoryBusiness implements ICategoryBusiness {

    private $iCategoryRepository = null;

    public function __construct(CategoryRepository $iCategoryRepository) {
        $this->iCategoryRepository = $iCategoryRepository;
    }

    public function all($take = null, $skip = null) {
        return $this->iCategoryRepository->all($take,$skip);
    }

    public function singleId($id) {
        return $this->iCategoryRepository->singleId($id);
    }

    public function create($obj) {
        $this->iCategoryRepository->create($obj);
    }

    public function update($obj) {
        $this->iCategoryRepository->update($obj);
    }
    
    public function delete($obj) {
        $this->iCategoryRepository->update($obj);
    }
}