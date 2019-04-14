<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Business\AdminBusiness;
use App\Http\Business\RoleBusiness;
use App\newses;
use App\Http\Business\NewsBusiness;
use App\Http\Business\CategoryBusiness;
use App\_Admin;
use App\category;
use Illuminate\Support\Facades\Storage;

class admin extends Controller
{
    private $adminBusiness;
    private $roleBusiness;
    private $newsBusiness;
    private $categoryBusiness;

    static $CreateNews = 'CreateNews';
    static $ApproveNews = 'AppoveNews';
    // static $DeleteNews = 'DeleteNews';
    // static $EditNews = 'EditNews';
    static $CreateAdmin = 'CreateAdmin';
    // static $ReadNews = 'ReadNews';

    public function __construct(AdminBusiness $adminBusiness, RoleBusiness $roleBusiness,
                    NewsBusiness $newsBusiness, CategoryBusiness $categoryBusiness) {
        $this->adminBusiness = $adminBusiness;
        $this->roleBusiness = $roleBusiness;
        $this->newsBusiness = $newsBusiness;
        $this->categoryBusiness = $categoryBusiness;
    }

    private function isContainRole($roleDetails, $roledetailName) {
        foreach($roleDetails as $roleDetail) {
            if($roleDetail->Name == $roledetailName) {
                return true;
            }
        }
        return false;
    }

    // hiện ko dùng đến
    public function index() {
        if(session('admin') == null)
            return redirect(route('login'));

        $admin = session('admin');
        $Roles = $admin->Role->RoleDetails;
        $roles = [];
        $roles[] = [self::$ApproveNews => $this->isContainRole($Roles, self::$ApproveNews)];
        $roles[] = [self::$CreateAdmin => $this->isContainRole($Roles,self::$CreateAdmin)];
        $roles[] = [self::$CreateNews => $this->isContainRole($Roles, self::$CreateNews)];
        $roles[] = [self::$DeleteNews => $this->isContainRole($Roles, self::$DeleteNews)];
        $roles[] = [self::$EditNews => $this->isContainRole($Roles, self::$EditNews)];
        $roles[] = [self::$ReadNews => $this->isContainRole($Roles, self::$ReadNews)];

        return view('admin',['roles' => $roles]);
        // return json_encode($roles);
    }

    public function managementNews() {
        if(session('admin') == null)
            return redirect(route('login'));
        $admin = session('admin');
        $pagrams = [];
        $roledetails = $admin->Role->RoleDetails;
        $pagrams[self::$CreateNews] = $this->isContainRole($roledetails, self::$CreateNews);
        // $pagrams[self::$ReadNews] = $this->isContainRole($roledetails,self::$ReadNews);
        // $pagrams[self::$EditNews] = $this->isContainRole($roledetails, self::$EditNews);
        // $pagrams[self::$DeleteNews] = $this->isContainRole($roledetails, self::$DeleteNews);
        $pagrams[self::$ApproveNews] = $this->isContainRole($roledetails, self::$ApproveNews);
        $pagrams[self::$CreateAdmin] = $this->isContainRole($roledetails, self::$CreateAdmin);

        if($pagrams[self::$ApproveNews]) {
            $pagrams['approveNewses'] = $this->newsBusiness->getNewsesNotApprove();
            $pagrams['ApprovedNewses'] =$this->newsBusiness->getNewsesByApprovedAdmin($admin->id,true);
        }

        if($pagrams[self::$CreateNews]) {
            $pagrams['NewsesWaiting'] = $this->newsBusiness->getNewsesByCreatedAdmin($admin->id);
            $pagrams['NewsesApproved'] = $this->newsBusiness->getNewsesByCreatedAdmin($admin->id,true);
        }

        if($pagrams[self::$CreateAdmin]) {
            $pagrams['createdAdmin'] = $this->adminBusiness->all();
        }
        
        return view('admin',['pagrams' => $pagrams]);
        // return json_encode($pagrams);

    }

    public function createNews() {
        if(session('admin') == null)
            return redirect(route('login'));

        if(!$this->isContainRole(session('admin')->Role->RoleDetails, self::$CreateNews))
            return redirect(route('403'));
        


        return view('createNews',['categories' => $this->categoryBusiness->all()]);
    }

    public function createNewsPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('login'));

        if(!$this->isContainRole(session('admin')->Role->RoleDetails, self::$CreateNews))
            return redirect(route('403'));

        $news = new newses();
        $news->Title = $request->input('title');
        $news->CateId = $request->input('category');
        $news->CreateBy = session('admin')->id;
        $news->Content = $request->input('content') != null ? $request->input('content') : '';
        $news->Decription = $request->input('decription');
        $news->CreateAt = date('ymdhis');

        if($news->Content == '') {
            return view('editNews', ['news' => $news, 'error' => 'Vui lòng nhập nội dung tin tức']);
        }

        if($request->file('image')->isValid()) {
            $news->Image = $request->file('image')->storeAs('images',date('ymdhis'));
        }

        $this->newsBusiness->create($news);

        return redirect(route('management'));
    }

    public function createAdmin() {
        if(session('admin') == null)
            return redirect(route('login'));

        if(!$this->isContainRole(session('admin')->Role->RoleDetails,self::$CreateAdmin))
            return redirect(route('403'));

        return view('createAdmin', ['roles' => $this->roleBusiness->all()]);
    }

    public function createAdminPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('login'));

        if(!$this->isContainRole(session('admin')->Role->RoleDetails,self::$CreateAdmin))
            return redirect(route('403'));

        $admin = new _Admin();
        $admin->FullName = $request->input('fullName');
        $admin->RoleId = $request->input('role');
        $admin->Email = $request->input('email');
        $admin->Password = $request->input('password');
        $this->adminBusiness->create($admin);
        
        return redirect(route('admin'));
    }

    public function approveNews($id) {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$ApproveNews))
            return redirect(route('403'));
        
        $news = $this->newsBusiness->singleId($id);
        $admin = $this->adminBusiness->singleId($news->CreateBy);
        $category = $this->categoryBusiness->singleId($news->CateId);
        $news->AdminName = $admin->FullName;
        $news->CategoryName = $category->Name;

        return view('approveNews',['news' => $news]);
        // return json_encode($news);
    }

    public function approveNewsPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$ApproveNews))
            return redirect(route('403'));
        
        $id = $request->input('id');
        $comment = $request->input('comment');
        $approve = $request->input('result') == 'true' ? true : false;
        $adminId = session('admin')->id;
        $this->newsBusiness->approve($id, $approve, $comment, $adminId);
        
        return redirect(route('admin'));
        // return json_encode($news);
    }

    public function addCategory() {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$ApproveNews))
            return redirect(route('403'));

        return view('addCategory');
    }

    public function addCategoryPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$ApproveNews))
            return redirect(route('403'));

        $category = new category();

        $category->Name = $request->input('name');

        $this->categoryBusiness->create($category);

        return redirect(route('admin'));
    }

    public function editNews($id) {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$CreateNews))
            return redirect(route('403'));

        $news = $this->newsBusiness->singleId($id);
        return view('editNews', [
            'news' => $news,
            'categories' => $this->categoryBusiness->all()
        ]);
    }

    public function editNewsPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('login'));
        
        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$CreateNews))
            return redirect(route('403'));

        $news = new newses();
        $news->id = $request->input('id');
        $news->Title = $request->input('title');
        $news->CateId = $request->input('category');
        $news->Content = $request->input('content');
        $news->Decription = $request->input('decription');

        if(empty($request->input('image'))) {
            $news->Image = $request->input('img_old');
        }

        if($news->Content == '') {
            return view('editNews', [
                'news' => $news,
                'error' => 'Vui lòng nhập nội dung tin tức',
                'categories' => $this->categoryBusiness->all()
            ]);
        }

        if($request->file('image') != null) {
            if($request->file('image')->isValid()) {
                $news->Image = $request->file('image')->storeAs('images',date('ymdhis'));
            }
        }

        $this->newsBusiness->update($news);

        $img_old = $request->input('img_old');

        if($request->file('image') != null && $request->file('image')->isValid()) {
            Storage::delete($img_old);
        }
        return redirect(route('admin'));
    }

    public function reviewNews($id) {
        if(session('admin') == null) {
            return redirect(route('admin'));
        }

        $roles = session('admin')->Role->RoleDetails;
        if(!$this->isContainRole($roles,self::$CreateNews))
            return redirect(route('403'));
        
        $news = $this->newsBusiness->singleId($id);
        $news->CategoryName = $this->categoryBusiness->singleId($news->CateId)->Name;
        return view('detailComment', ['news' => $news]);
    }

    public function detailAdmin(int $id = null) {
        if(session('admin') == null)
            return redirect(route('admin'));
        
        $roles = session('admin')->Role->RoleDetails;
        if($this->isContainRole($roles, self::$CreateNews)) {
            $adminId = $id == null ? session('admin')->id : $id;
            $admin = $this->adminBusiness->singleId($adminId);
            $admin->Role = $this->roleBusiness->singleId($admin->roleId);
            return view('detailAdmin',['admin' => $admin]);
        } else {
            return view('detailAdmin', ['admin' => session('admin')]);
        }
    }

    public function changePasswordAdmin(int $id = null) {
        if(session('admin') == null)
            return redirect(route('admin'));
        
        return view('password');
    }

    public function changePasswordAdminPost(Request $request) {
        if(session('admin') == null)
            return redirect(route('admin'));
        
        $roles = session('admin')->Role->RoleDetails;
        if($this->isContainRole($roles, self::$CreateAdmin)) {
            $id = $request->input('id');
            $password = $request->input('password');
            $this->adminBusiness->passowrdChange($id,$password);
        } else {
            $id = session('admin')->id;
            $password = $request->input('password');
            $this->adminBusiness->passowrdChange($id,$password);
        }

        return redirect(route('detailAdmin'));
    }
}
