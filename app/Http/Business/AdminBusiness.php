<?php
namespace App\Http\Business;
use App\Http\Repository\AdminRepository;

interface IAdminBusiness extends IBusinessBase {
    function singleEmailPassword($email = '', $password = '');
    function passowrdChange($id, $password);
}

class AdminBusiness implements IAdminBusiness {

    private $iAdminRepository = null;

    public function __construct(AdminRepository $iAdminRepository) {
        $this->iAdminRepository = $iAdminRepository;
    }

    public function all($take = null, $skip = null) {
        return $this->iAdminRepository->all($take, $skip);
    }

    public function singleId($id) {
        return $this->iAdminRepository->singleId($id);
    }

    public function create($obj) {
        $obj->Password = sha1($obj->Password,false);
        $this->iAdminRepository->create($obj);
    }

    public function update($obj) {
        $this->iAdminRepository->update($obj);
    }

    public function delete($obj) {
        $this->iAdminRepository->delete($obj);
    }

    public function singleEmailPassword($email = '', $password = '') {
        $password = sha1($password, false);
        return $this->iAdminRepository->singleEmailPassword($email, $password);
    }

    public function passowrdChange($id, $password) {
        $password = sha1($password, false);
        $this->iAdminRepository->passowrdChange($id, $password);
    }

}