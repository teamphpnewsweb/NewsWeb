<?php

namespace App\Http\Repository;
use App\role;
use  Model\_Role;
use Mockery\Exception;

interface IRoleRepository extends IRepositoryBase {

}

class RoleRepository implements IRoleRepository {

    function all($take = null, $skip = null) {
        $roles = role::all();

        if($skip != null && $skip > 0) {
            $roles = $roles->skip($skip);
        }

        if($take != null && $take > 0) {
            $roles = $roles->take($take);
        }

        $roles = $roles->toArray();

        $roleS = [];

        foreach($roles as $role) {
            $rolE = new role();
            $rolE->id = $role['id'];
            $rolE->Name = $role['Name'];
            $roleS[] = $rolE;
        }

        return $roleS;
    }

    function singleId($id) {
        $role = role::find($id);
        $rolE = new role();
        $rolE->id = $role['id'];
        $rolE->Name = $role['Name'];

        return $rolE;
    }

    function create($obj) {
        $obj->id = role::insertGetId([
            'Name' => $obj->Name
        ]);
    }

    function update($obj) {
        role::where('id',$obj->id)->update([
            'Name' => $obj->Name
        ]);
    }

    function delete($obj) {
        throw new Exception('Chức năng này hiện không có');
    }
}