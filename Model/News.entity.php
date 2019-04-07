<?php

namespace Model;

class News {
    public $id;
    public $Title;
    public $Content;
    public $Decription;
    public $Image;
    public $CreateAt;
    public $DeletedAt;
    public $Approved;

    public $CateId;
    public $AppovedBy;
    public $DeletedBy;
    public $CreateBy;
}