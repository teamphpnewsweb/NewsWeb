<?php

namespace App\Http\Business;

use App\Http\Business\IBusinessBase;
use App\Http\Repository\INewsRepository;

interface INewsBusiness extends IBusinessBase {
    function approve($obj);
    function getNewsesByCate($cateId,$take = null, $skip = null);
}

class NewsBusiness implements INewsBusiness {

    private $iNewsRepository = null;

    public function __construct(INewsRepository $iNewsRepository) {
        $this->iNewsRepository = $iNewsRepository;
    }

    public function all($take = null, $skip = null) {
        return $this->iNewsRepository->all($take, $skip);
    }

    public function singleId($id) {
        return $this->iNewsRepository->singleId($id);
    }

    public function create($obj) {
        $this->iNewsRepository->create($obj);
    }

    public function update($obj) {
        $this->iNewsRepository->update($obj);
    }
    public function delete($obj) {
        $this->iNewsRepository->delete($obj);
    }

    public function approve($obj) {
        $this->iNewsRepository->approve($obj);
    }

    public function getNewsesByCate($cateId,$take = null, $skip = null) {
        $this->iNewsRepository->getNewsesByCate($cateId, $take, $skip);
    }
}