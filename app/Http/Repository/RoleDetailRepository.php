<?php

namespace App\Http\Repository;

use App\roleDetail;
use League\Flysystem\Exception;

interface IRoleDetailRepository extends IRepositoryBase {
    function getRoleDetailsByRoleId($id);
}

class RoleDetailRepository implements IRoleDetailRepository {
    function all($take = null, $skip = null) {
        $roleDetails = roleDetail::all();

        if($skip != null && $skip > 0) {
            $roleDetails = $roleDetails->skip($skip);
        }
        if($take != null && $take > 0) {
            $roleDetails = $roleDetails->take($take);
        }

        $roleDetails = $roleDetails->toArray();
        $roleDetailS = [];

        foreach($roleDetails as $roleDetail) {
            $roledetail = new roleDetail();
            $roledetail->id = $roleDetail['id'];
            $roledetail->Name = $roleDetail['Name'];
            $roleDetailS[] = $roledetail;
        }
        return $roleDetailS;
    }
    function singleId($id) {
        $roleDetail = roleDetail::find($id);
        $roledetail = new roleDetail();
        $roledetail->id = $roleDetail['id'];
        $roledetail->Name = $roleDetail['Name'];

        return $roledetail;
    }
    function create($obj) {
        $obj->id = roleDetail::insertGetId([
            'Name' => $obj->Name
        ]);
    }

    function update($obj) {
        roleDetail::where('id',$obj->id)->update([
            'Name' => $obj->Name
        ]);
    }

    function delete($obj) {
        throw new Exception('Chức năng này hiện chưa có');
    }

    function getRoleDetailsByRoleId($id) {
        $roleDetails = roleDetail::where('roleId',$id)->get();
        $roledetails = [];

        foreach($roleDetails as $roleDetail) {
            $roledetail = new roleDetail();
            $roledetail->id = $roleDetail['id'];
            $roledetail->Name = $roleDetail['Name'];
            $roledetails[] = $roledetail;
        }

        return $roledetails;
    }
}