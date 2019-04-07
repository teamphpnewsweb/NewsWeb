<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Business\INewsBusiness;
use App\Http\Business\ICategoryBusiness;

class news extends Controller
{
    private $iCategoryBusiness = null;
    private $iNewsBusiness = null;
    public function __construct(INewsBusiness $iNewsBusiness, ICategoryBusiness $iCategoryBusiness) {
        $this->iCategoryBusiness = $iCategoryBusiness;
        $this->iNewsBusiness = $iNewsBusiness;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function list_category($id) {

    }

    public function category($id) {

    }
}
