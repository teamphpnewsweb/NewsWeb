<?php
namespace App\Http\Business;
use App\Http\Repository\IAdminRepository;

interface IAdminBusiness extends IBusinessBase {
    function singleEmailPassword($email = '', $password = '');
    function passowrdChange($id, $password);
}

class AdminBusiness implements IAdminBusiness {

    private $iAdminRepository = null;

    public function __construct(IAdminRepository $iAdminRepository) {
        $this->iAdminRepository = $iAdminRepository;
    }

    function all($take = null, $skip = null) {
        return $this->iAdminRepository->all($take, $skip);
    }

    function singleId($id) {
        return $this->iAdminRepository->singleId($id);
    }

    function create($obj) {
        $this->iAdminRepository->create($obj);
    }

    function update($obj) {
        $this->iAdminRepository->update($obj);
    }

    function delete($obj) {
        $this->iAdminRepository->delete($obj);
    }

    function singleEmailPassword($email = '', $password = '') {
        return $this->iAdminRepository->singleEmailPassword($email, $password);
    }

    function passowrdChange($id, $password) {
        $this->iAdminRepository->passowrdChange($id, $password);
    }

}