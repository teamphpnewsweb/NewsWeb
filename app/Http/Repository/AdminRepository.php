<?php
namespace App\Http\Repository;

use Mockery\CountValidator\Exception;
use App\_Admin;

interface IAdminRepository extends IRepositoryBase {
    function singleEmailPassword($email = '', $password = '');
    function passowrdChange($id, $password);
}

class AdminRepository implements IAdminRepository {
    
    private function getAdmin($admin) {
        $adm = new _Admin();
        $adm->id = $admin['id'];
        $adm->FullName = $admin['FullName'];
        $adm->Email = $admin['Email'];
        $adm->Password = $admin['Password'];
        $adm->RoleId = $admin['roleId'];
        return $adm;
    }

    public function all($take = null, $skip = null) {
        $admins = _Admin::all()->toArray();
        $adms = [];
        foreach($admins as $admin) {
            $adm = $this->getAdmin($admin);
            $adms[] = $adm;
        }

        return $adms;
    }

    public function singleId($id) {
        $admin = _Admin::find($id);
        return $this->getAdmin($admin);
    }

    public function create($obj) {
        $obj->id = _Admin::insertGetId([
            'FullName' => $obj->FullName,
            'Email' => $obj->Email,
            'roleId' => $obj->RoleId,
            'Password' => $obj->Password
        ]);
    }

    public function update($obj) {
        $admin = _Admin::where('id',$obj->id)->update(
            [
                'FullName' => $obj->FullName,
                'Email' => $obj->Email,
                'roleId' => $obj->RoleId,
            ]);
            
        $admin->save();
    }

    public function delete($obj) {
        throw new Exception('Chức năng này hiện không dùng được.');
    }

    public function singleEmailPassword($email = '', $password = '') {
        if($email != '' || $password != '') {
            $admin = _Admin::where([
                ['Email',$email],
                ['Password',$password]
            ])->first();
    
            if($admin != null) {
                return $this->getAdmin($admin);
            }
        }
        return null;
    }
    
    public function passowrdChange($id, $password) {
        _Admin::where('id',$id)->update(
            ['Password' => $password]
        );
    }
}