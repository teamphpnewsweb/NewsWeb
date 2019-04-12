<?php

namespace App\Http\Business;

use App\Http\Business\IBusinessBase;
use App\Http\Repository\NewsRepository;
use App\Http\Repository\AdminRepository;

interface INewsBusiness extends IBusinessBase {
    function approve($id, $result, $adminId);
    function getNewsesByCate($cateId,$take = null, $skip = null);
    function getNewsesByCateId($cateId, $newsid, $take = null, $skip = null);
    function getNewsesNotApprove($adminId);
}

class NewsBusiness implements INewsBusiness {

    private $iNewsRepository = null;
    private $adminRepository = null;

    public function __construct(NewsRepository $iNewsRepository, AdminRepository $adminRepository) {
        $this->iNewsRepository = $iNewsRepository;
        $this->adminRepository = $adminRepository;
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

    public function approve($id, $result, $adminId) {
        $this->iNewsRepository->approve($id, $result, $adminId);
    }

    public function getNewsesByCate($cateId,$take = null, $skip = null) {
        return $this->iNewsRepository->getNewsesByCate($cateId, $take, $skip);
    }

    public function getNewsesByCateId($cateId, $newsid, $take = null, $skip = null) {
        return $this->iNewsRepository->getNewsesByCateId($cateId,$newsid,$take,$skip);
    }

    public function getNewsesNotApprove($adminId = null) {
        $newses = $this->iNewsRepository->getNewsesNotApprove($adminId);
        foreach($newses as $news) {
            $news->AdminName = $this->adminRepository->singleId($news->CreateBy)->FullName;
        }
        return $newses;
    }
}