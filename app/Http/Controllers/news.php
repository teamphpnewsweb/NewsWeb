<?php

namespace App\Http\Controllers;

use App\Http\Business\NewsBusiness;
use App\Http\Business\CategoryBusiness;

class news extends Controller
{
    private $iCategoryBusiness = null;
    private $iNewsBusiness = null;
    
    public function __construct(CategoryBusiness $iCategoryBusiness, NewsBusiness $iNewsBusiness) {
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
        $categories = $this->iCategoryBusiness->all();
        foreach($categories as $category) {
            $category->Newses = $this->iNewsBusiness->getNewsesByCate($category->id,6);
        }

        return view('home',['categories' => $categories]);
        // return json_encode($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->iCategoryBusiness->singleId($id);
        $category->Newses = $this->iNewsBusiness->getNewsesByCate($id);

        return view('category',['category' => $category]);
        // return json_encode($category);
    }

    public function newsDetail($id) {
        $news = $this->iNewsBusiness->singleId($id);
        $newses = $this->iNewsBusiness->getNewsesByCateId($news->CateId, $news->id, 8);

        return view('newsdetail',['news' => $news, 'newses' => $newses]);
        // return json_encode($news);
    }
}
