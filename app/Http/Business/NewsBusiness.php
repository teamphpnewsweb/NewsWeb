<?php

namespace App\Http\Business;

use App\Http\Business\IBusinessBase;
use App\Http\Repository\NewsRepository;
use App\Http\Repository\AdminRepository;

interface INewsBusiness extends IBusinessBase {
    function approve($id, $result, $comment, $adminId);
    function getNewsesByCate($cateId,$take = null, $skip = null);
    function getNewsesByCateId($cateId, $newsid, $take = null, $skip = null);
    function getNewsesNotApprove($adminId);
    function getNewsesByCreatedAdmin($adminId, $approved = false);
    function getNewsesByApprovedAdmin($adminId = null, $approved = false);
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

    public function approve($id, $result, $comment, $adminId) {
        $this->iNewsRepository->approve($id, $result, $comment, $adminId);
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

    public function getNewsesByCreatedAdmin($adminId, $approved = false) {
        $newses = $this->iNewsRepository->getNewsesByCreatedAdmin($adminId, $approved);
        foreach($newses as $news) {
            $news->AdminName = $this->adminRepository->singleId($news->CreateBy)->FullName;
            if($approved) {
                $news->ApprovedName = $this->adminRepository->singleId($news->ApprovedBy)->FullName;
            }
        }
        return $newses;
    }

    public function getNewsesByApprovedAdmin($adminId = null, $approved = false) {
        $newses = $this->iNewsRepository->getNewsesByApprovedAdmin($adminId, $approved);
        foreach($newses as $news) {
            $news->AdminName = $this->adminRepository->singleId($news->CreateBy)->FullName;
        }
        return $newses;
    }
}