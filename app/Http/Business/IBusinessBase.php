<?php 
namespace App\Http\Business;

interface IBusinessBase {
    function all($take = null, $skip = null);
    function singleId($id);
    function create($obj);
    function update($obj);
    function delete($obj); 
}