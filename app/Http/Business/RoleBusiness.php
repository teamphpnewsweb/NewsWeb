<?php

namespace App\Http\Business;

use App\Http\Repository\RoleRepository;
use App\Http\Repository\RoleDetailRepository;

interface IRoleBusiness extends IBusinessBase {

}

class RoleBusiness implements IRoleBusiness {
    private $iRoleRepository;
    private $iRoleDetailRepository;

    public function __construct(RoleRepository $iRoleRepository,
        RoleDetailRepository $iRoleDetailRepository) {

            $this->iRoleRepository = $iRoleRepository;
            $this->iRoleDetailRepository = $iRoleDetailRepository;
    }

    public function all($take = null, $skip = null) {
        $roles = $this->iRoleRepository->all($take,$skip);
        foreach($roles as $role) {
            $role->RoleDetails = $this->iRoleDetailRepository->getRoleDetailsByRoleId($role->id);
        }

        return $roles;
    }

    function singleId($id) {
        $role = $this->iRoleRepository->singleId($id);
        $role->RoleDetails = $this->iRoleDetailRepository->getRoleDetailsByRoleId($role->id);
        return $role;
    }

    function create($obj) {
        $this->iRoleRepository->create($obj);
    }

    function update($obj) {
        $this->iRoleRepository->update($obj);
    }

    function delete($obj) {
        $this->iRoleRepository->delete($obj);
    }
}