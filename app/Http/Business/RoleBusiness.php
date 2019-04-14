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

    public function singleId($id) {
        $role = $this->iRoleRepository->singleId($id);
        $role->RoleDetails = $this->iRoleDetailRepository->getRoleDetailsByRoleId($role->id);
        return $role;
    }

    public function create($obj) {
        $this->iRoleRepository->create($obj);
    }

    public function update($obj) {
        $this->iRoleRepository->update($obj);
    }

    public function delete($obj) {
        $this->iRoleRepository->delete($obj);
    }
}