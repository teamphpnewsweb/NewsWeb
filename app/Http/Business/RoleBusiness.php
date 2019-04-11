<?php

namespace App\Http\Business;

use App\Http\Repository\IRoleDetailRepository;

interface IRoleBusiness extends IBusinessBase {

}

class RoleBusiness implements IRoleBusiness {
    private $iRoleRepository;
    private $iRoleDetailRepository;

    public function __construct(IRoleBusiness $iRoleBusiness,
        IRoleDetailRepository $iRoleDetailRepository) {

            $this->iRoleRepository = $iRoleBusiness;
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
        $role->RoleDetails = $this->iRoleDetailRepository($id);
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