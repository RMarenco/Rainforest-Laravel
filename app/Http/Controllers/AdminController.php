<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;


class AdminController extends Controller
{
	/**
    * Create a new controller instance.
    *
    * @return void
    */
    /*public function __construct()
    {        
        $this->middleware('auth:admin');
    }*/

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
	*/
    public function index(){
		return view('admin');
	}

    public function home(){
        return view('/admin/index', array('admin' => Auth::user()));
    }

    public function update_avatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename));

            $admin = Auth::user();
            $admin->avatar = $filename;
            $admin->save();
        }

        return view('/admin/index', array('admin' => Auth::user()));
    }

    public function users(){
        return view('admin/Users/users', array('admin' => Auth::user()));
    }

    public function user_products(){
        return view('admin/Users/Products/products', array('admin' => Auth::user()));
    }


    public function categories(){
        return view('admin/Categories/categories', array('admin' => Auth::user()));
    }

    public function addcategories(){
        return view('admin/Categories/addCategories', array('admin' => Auth::user()));
    }

    public function add_categories(Request $request){

        $category = $request->input('category');
        $sql = DB::table('categories')->where('category', '=', $category)->count();
        if($sql > 0){
            return redirect()->back()->with('errors', 'That category already exists!')->withInput($request->only('category'));                    
        }else{
            DB::insert("insert into categories (category, Icon) values ('$category', 'armor')");            
            return view('admin/Categories/categories', array('admin' => Auth::user()));
        }

    }

    public function updatecategories(){
        return view('admin/Categories/updateCategories', array('admin' => Auth::user()));
    }

    public function update_categories(Request $request){
        $id = $request->input('id');
        $category = $request->input('category');
        DB::update("update categories set category = '$category' where idCategory = '$id'");
        return view('admin/Categories/categories', array('admin' => Auth::user()));
    }

    public function updateproduct(){
        return view('admin/Users/Products/updateProduct', array('admin' => Auth::user()));
    }

    public function update_product(Request $request){
        if($request->hasFile('pImage')){
            $image = $request->file('pImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path('products/' . $filename));
            $name = $request->input('pName');
            $description = $request->input('pDescription');
            $quantity = $request->input('pQuantity');
            $price = $request->input('pPrice');
            $category = $request->get('pCategory');
            $id = $request->input('id');
            $discount = $request->get('discount');
            DB::update("update products set product = '$name', description = '$description', quantity = '$quantity', price = '$price', discount = '$discount', image = '$filename', idCategory = '$category' where idProduct = '$id'");
        }else{
            $name = $request->input('pName');
            $description = $request->input('pDescription');
            $quantity = $request->input('pQuantity');
            $price = $request->input('pPrice');
            $category = $request->get('pCategory');
            $id = $request->input('id');
            $discount = $request->get('discount');
            DB::update("update products set product = '$name', description = '$description', quantity = '$quantity', price = '$price', discount = '$discount', idCategory = '$category' where idProduct = '$id'");
        }
        $idUser = $request->input('idUser');
        return redirect('admin/users/products?Id='.$idUser.'');

    }

    public function display(){
        return view('admin/Users/Products/displayProductOn');
    }

    public function hide(){
        return view('admin/Users/Products/displayProductOff');
    }

    public function admins(){
        return view('admin/admins/admins', array('admin' => Auth::user()));
    }

    public function addadmins(){
        return view('admin/admins/addAdmins', array('admin' => Auth::user()));
    }

    public function add_admins(Request $request){        
        $admin = $request->get('id');
        $isAdmin = $request->get('isAdmin');        
        DB::update("update users set isAdmin = '$isAdmin' where id = '$admin'");

        return view('admin/admins/admins', array('admin' => Auth::user()));
    }
}
