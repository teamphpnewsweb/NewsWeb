<?php
namespace App\Http\Repository;

use Mockery\CountValidator\Exception;
use App\_Admin;

interface IAdminRepository extends IRepositoryBase {
    function singleEmailPassword($email = '', $password = '');
    function passowrdChange($id, $password);
}

class AdminRepository implements IAdminRepository {
    
    public function all($take = null, $skip = null) {
        throw new Exception('Chức năng này hiện không dùng được.');
    }

    public function singleId($id) {
        throw new Exception('Chức năng này hiện không dùng được.');
    }
    function create($obj) {
        $obj->id = _Admin::insertGetId([
            'FullName' => $obj->FullName,
            'Email' => $obj->Email,
            'Password' => $obj->Password
        ]);
    }
    public function update($obj) {
        $admin = _Admin::find($obj->id);

        $admin['FullName'] = $obj->FullName;
        $admin['Email'] = $obj->Email;
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
                $adm = new _Admin();
                $adm->id = $admin['id'];
                $adm->FullName = $admin['FullName'];
                $adm->Email = $admin['Email'];
                $adm->Password = $admin['Password'];
                return $adm;
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