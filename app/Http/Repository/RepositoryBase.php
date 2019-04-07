<?php

namespace App\Http\Repository;

interface IRepositoryBase {
    function all($take = null, $skip = null);
    function singleId($id);
    function create($obj);
    function update($obj);
    function delete($obj);
}