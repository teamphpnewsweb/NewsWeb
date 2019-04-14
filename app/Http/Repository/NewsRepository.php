<?php

namespace App\Http\Repository;

use App\Http\Repository\IRepositoryBase;
use App\newses;

interface INewsRepository extends IRepositoryBase
{
    function approve($id, $result, $comment, $adminId);
    function getNewsesByCate($cateId, $take = null, $skip = null);
    function getNewsesByCateId($cateId, $newsId, $take = null, $skip = null);
    function getNewsesNotApprove($adminId = null);
    function getNewsesByCreatedAdmin($adminId, $approve = null);
    function getNewsesByApprovedAdmin($adminId = null, $approved = null);
 }

class NewsRepository implements INewsRepository
{
    private function getNews($news) {
        $newS = new newses();
        $newS->id = $news['id'];
        $newS->Title = $news['Title'];
        $newS->Decription = $news['Decription'];
        $newS->Image = $news['Image'];
        $newS->Content = $news['Content'];
        $newS->CreateAt = $news['CreateAt'];
        $newS->DeletedAt = $news['DeletedAt'];
        $newS->Approved = $news['Approved'];
        $newS->CateId = $news['CateId'];
        $newS->ApprovedBy = $news['AppovedBy'];
        $newS->DeletedBy = $news['DeletedBy'];
        $newS->CreateBy = $news['CreateBy'];
        $newS->Comment = $news['Comment'];
        return $newS;
    }

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
        foreach ($newss as $news) {
            $newsess[] = $this->getNews($news);
        }

        return $newsess;
    }

    public function singleId($id) {
        $news = newses::find($id);
        if($news != null) {
            return $this->getNews($news);
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
        newses::where('id',$obj->id)->update([
            'CateId' => $obj->CateId,
            'Title' => $obj->Title,
            'Content' => $obj->Content,
            'Decription' => $obj->Decription,
            'Image' => $obj->Image,
            'Approved' => null
        ]);
    }

    public function delete($obj) {
        $news = newses::find($obj->id);
        $news['DeletedAt'] = $obj->DeletedAt;
        $news['DeletedBy'] = $obj->DeletedBy;
        $news->save();
    }

    public function approve($id, $result, $comment, $adminId) {
        newses::where('id', $id)->update([
            'AppovedBy' => $adminId,
            'Approved' => $result,
            'Comment' => $comment,
            'ApprovedAt' => date('ymdhis')
        ]);
    }

    public function getNewsesByCate($cateId, $take = null, $skip = null) {
        $newss = newses::where([
            ['DeletedBy',null],
            ['CateId',$cateId],
            ['Approved', true]
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
            $newsess[] = $this->getNews($news);
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
            $newsess[] = $this->getNews($news);
        }
        return $newsess;
    }

    public function getNewsesNotApprove($adminId = null) {
        $newses = newses::where([
            ['Approved',null],
            ['DeletedBy', null]
            ]);

        if($adminId != null) {
            $newses = $newses->where('CreateBy',$adminId);
        }

        $newses = $newses->orderBy('id','desc')->get();
        $newss = [];
        foreach($newses as $news) {
            $newss[] = $this->getNews($news);
        }
        return $newss;
    }

    public function getNewsesByCreatedAdmin($adminId, $approved = false) {
        $newses = newses::where('CreateBy',$adminId);
        if($approved) {
            $newses = $newses->where('Approved', '<>', null)->orderBy('ApprovedAt','desc');
        } else {
            $newses = $newses->where('Approved', null)->orderBy('id','desc');
        }
        $newses = $newses->orderBy('id')->get();
        $newseS = [];
        foreach($newses as $news) {
            $newseS[] = $this->getNews($news);
        }
        return $newseS;
    }

    public function getNewsesByApprovedAdmin($adminId = null, $approved = false) {
        $newses = newses::where('AppovedBy',$adminId);
        if($approved) {
            $newses = $newses->where('Approved', '<>', null)->orderBy('ApprovedAt','desc');
        } else {
            $newses = $newses->where('Approved', null)->orderBy('id','desc');
        }
        $newses = $newses->get();
        $newseS = [];
        foreach($newses as $news) {
            $newseS[] = $this->getNews($news);
        }
        return $newseS;
    }
}