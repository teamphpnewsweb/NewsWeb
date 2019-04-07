<?php

namespace App\Http\Repository;

use App\Http\Repository\IRepositoryBase;
use App\newses;
use Model\News;

interface INewsRepository extends IRepositoryBase
{
    function approve($obj);
    function getNewsesByCate($cateId,$take = null, $skip = null);
 }

class NewsRepository implements INewsRepository
{
    public function all($take = null, $skip = null)
    {
        $newss = newses::whereNotNull('DeletedBy');
        if($skip != null && $skip > 0) {
            $newss = $newss->skip($skip);
        }
        if($take != null && $take > 0) {
            $newss = $newss->take($take);
        }
        $newss= $newss->get();

        $newsess = array();
        $i = -1;
        foreach ($newss as $news) {
            $i++;
            $newsess[$i] = new News;
            $newsess[$i]->id = $news['id'];
            $newsess[$i]->Title = $news['Title'];
            $newsess[$i]->Decription = $news['Decription'];
            $newsess[$i]->Image = $news['Image'];
            $newsess[$i]->Content = $news['Content'];
            $newsess[$i]->CreateAt = $news['CreateAt'];
            $newsess[$i]->DeletedAt = $news['DeletedAt'];
            $newsess[$i]->Approved = $news['Approved'];
            $newsess[$i]->CateId = $news['CateId'];
            $newsess[$i]->ApproveBy = $news['ApprovedBy'];
            $newsess[$i]->DeletedBy = $news['DeletedBy'];
            $newsess[$i]->CreateBy = $news['CreateBy'];
        }
        return $newsess;
    }

    public function singleId($id)
    {
        $news = newses::find($id);
        $news1 = new News();
        $news1->id = $news->id;
        $news1->Title = $news->Title;
        $news1->Content = $news->Content;
        $news1->Decription = $news->Decription;
        $news1->Image = $news->Image;
        $news1->CreateAt = $news->CreateAt;
        $news1->DeletedAt = $news->DeletedAt;
        $news1->Approved = $news->Approved;
        $news1->CateId = $news->CateId;
        $news1->AppovedBy = $news->AppovedBy;
        $news1->DeletedBy = $news->DeletedBy;
        $news1->CreateBy = $news->CreateBy;

        return $news1;
    }

    public function create($obj) {
        $obj->id = newses::insertGetId([
            'CateId' => $obj->CateId,
            'CreateBy' => $obj->CreateBy,
            'Title' => $obj->Title,
            'Content' => $obj->Content,
            'Decription' => $obj->Decription,
            'Image' => $obj->Image,
            'CreateAt' => $obj->CreateAt
        ]);
    }
    public function update($obj) {
        $news = newses::find($obj->id);
        $news->CateId = $obj->CateId;
        $news->Title = $obj->Title;
        $news->Content = $obj->Content;
        $news->Decription = $obj->Decription;
        $news->Image = $obj->Image;
        $news->save();
    }

    public function delete($obj) {
        $news = newses::find($obj->id);
        $news->DeletedAt = $obj->DeletedAt;
        $news->DeletedBy = $obj->DeletedBy;
        $news->save();
    }

    public function approve($obj) {
        $news = newses::find($obj->id);
        $news->AppovedBy = $obj->AppovedBy;
        $news->Approved = $obj->Approved;
        $news->save();
    }

    public function getNewsesByCate($cateId, $take = null, $skip = null) {
        $newss = newses::whereNotNull('DeletedBy')
                        ->andwhere('CateId',$cateId);
        if($skip != null && $skip > 0) {
            $newss = $newss->skip($skip);
        }
        if($take != null && $take > 0) {
            $newss = $newss->take($take);
        }
        $newss= $newss->get();
        $newsess = array();
        $i = -1;
        foreach ($newss as $news) {
            $i++;
            $newsess[$i] = new News;
            $newsess[$i]->id = $news['id'];
            $newsess[$i]->Title = $news['Title'];
            $newsess[$i]->Decription = $news['Decription'];
            $newsess[$i]->Image = $news['Image'];
            $newsess[$i]->Content = $news['Content'];
            $newsess[$i]->CreateAt = $news['CreateAt'];
            $newsess[$i]->DeletedAt = $news['DeletedAt'];
            $newsess[$i]->Approved = $news['Approved'];
            $newsess[$i]->CateId = $news['CateId'];
            $newsess[$i]->ApproveBy = $news['ApprovedBy'];
            $newsess[$i]->DeletedBy = $news['DeletedBy'];
            $newsess[$i]->CreateBy = $news['CreateBy'];
        }
        return $newsess;
    }
}
