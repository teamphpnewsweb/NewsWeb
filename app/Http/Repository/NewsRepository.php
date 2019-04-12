<?php

namespace App\Http\Repository;

use App\Http\Repository\IRepositoryBase;
use App\newses;
use Model\_News;

interface INewsRepository extends IRepositoryBase
{
    function approve($id, $result, $adminId);
    function getNewsesByCate($cateId,$take = null, $skip = null);
    function getNewsesByCateId($cateId, $newsId,$take = null, $skip = null);
    function getNewsesNotApprove($adminId);
 }

class NewsRepository implements INewsRepository
{
    public function all($take = null, $skip = null) {
        $newss = newses::whereNull('DeletedBy')->where('Approved', 1)->orderBy('id','desc');
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
            $newsess[$i] = new newses();
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

    public function singleId($id) {
        $news = newses::find($id);
        if($news != null) {
            $news1 = new newses();
            $news1->id = $news['id'];
            $news1->Title = $news['Title'];
            $news1->Content = $news['Content'];
            $news1->Decription = $news['Decription'];
            $news1->Image = $news['Image'];
            $news1->CreateAt = $news['CreateAt'];
            $news1->DeletedAt = $news['DeletedAt'];
            $news1->Approved = $news['Approved'];
            $news1->CateId = $news['CateId'];
            $news1->AppovedBy = $news['AppovedBy'];
            $news1->DeletedBy = $news['DeletedBy'];
            $news1->CreateBy = $news['CreateBy'];
            return $news1;
        }
        return null;        
    }

    public function create($obj) {
        $obj->id = newses::insertGetId([
            'CateId' => $obj->CateId,
            'CreateBy' => $obj->CreateBy,
            'Title' => $obj->Title,
            'Content' => $obj->Content,
            'Decription' => $obj->Decription,
            'Image' => $obj->Image,
            'CreateAt' => $obj->CreateAt,
            'DeletedAt' => null
        ]);
    }

    public function update($obj) {
        $news = newses::find($obj->id);
        $news['CateId'] = $obj->CateId;
        $news['Title'] = $obj->Title;
        $news['Content'] = $obj->Content;
        $news['Decription'] = $obj->Decription;
        $news['Image'] = $obj->Image;
        $news->save();
    }

    public function delete($obj) {
        $news = newses::find($obj->id);
        $news['DeletedAt'] = $obj->DeletedAt;
        $news['DeletedBy'] = $obj->DeletedBy;
        $news->save();
    }

    public function approve($id, $result, $adminId) {
        $news = newses::find($id);
        $news['AppovedBy'] = $adminId;
        $news['Approved'] = $result;
        $news->save();
    }

    public function getNewsesByCate($cateId, $take = null, $skip = null) {
        $newss = newses::where([
            ['DeletedBy',null],
            ['CateId',$cateId],
            ['AppovedBy','<>', null]
        ])->orderBy('id','desc');
        if($skip != null && $skip > 0) {
            $newss = $newss->skip($skip);
        }
        if($take != null && $take > 0) {
            $newss = $newss->take($take);
        }
        $newss= $newss->get();
        $newsess = [];
        foreach ($newss as $news) {
            $newseSS = new newses();
            $newseSS->id = $news['id'];
            $newseSS->Title = $news['Title'];
            $newseSS->Decription = $news['Decription'];
            $newseSS->Image = $news['Image'];
            $newseSS->Content = $news['Content'];
            $newseSS->CreateAt = $news['CreateAt'];
            $newseSS->DeletedAt = $news['DeletedAt'];
            $newseSS->Approved = $news['Approved'];
            $newseSS->CateId = $news['CateId'];
            $newseSS->ApproveBy = $news['AppovedBy'];
            $newseSS->DeletedBy = $news['DeletedBy'];
            $newseSS->CreateBy = $news['CreateBy'];
            $newsess[] = $newseSS;
        }
        return $newsess;
    }

    public function getNewsesByCateId($cateId, $newsId,$take = null, $skip = null) {
        $newss = newses::where([
            ['DeletedBy', null],
            ['CateId', $cateId],
            ['id','!=',$newsId],
            ['AppovedBy', '<>', null]
        ])->orderBy('id','desc');
        if($skip != null && $skip > 0) {
            $newss = $newss->skip($skip);
        }
        if($take != null && $take > 0) {
            $newss = $newss->take($take);
        }
        $newss= $newss->get();
        $newsess = [];
        foreach ($newss as $news) {
            $newseSS = new newses();
            $newseSS->id = $news['id'];
            $newseSS->Title = $news['Title'];
            $newseSS->Decription = $news['Decription'];
            $newseSS->Image = $news['Image'];
            $newseSS->Content = $news['Content'];
            $newseSS->CreateAt = $news['CreateAt'];
            $newseSS->DeletedAt = $news['DeletedAt'];
            $newseSS->Approved = $news['Approved'];
            $newseSS->CateId = $news['CateId'];
            $newseSS->ApproveBy = $news['AppovedBy'];
            $newseSS->DeletedBy = $news['DeletedBy'];
            $newseSS->CreateBy = $news['CreateBy'];
            $newsess[] = $newseSS;
        }
        return $newsess;
    }

    public function getNewsesNotApprove($adminId = null) {
        $newses = newses::where([
            ['AppovedBy',null],
            ['DeletedBy', null]
            ]);

        if($adminId != null) {
            $newses = $newses->where('CreateBy',$adminId);
        }

        $newses = $newses->orderBy('id','desc')->get();
        $newss = [];
        foreach($newses as $news) {
            $n = new newses();
            $n->id = $news['id'];
            $n->Title = $news['Title'];
            $n->Decription = $news['Decription'];
            $n->CreateAt = $news['CreateAt'];
            $n->CreateBy = $news['CreateBy'];
            $n->CreateAt = $news['CreateAt'];
            $newss[] = $n;
        }
        return $newss;
    }
}
