<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function profile(){
		return view('settings', array('user' => Auth::user()));
	}
	
	public function update_avatar(Request $request){

		if($request->hasFile('avatar')){
			$avatar = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename));

			$user = Auth::user();
			$user->avatar = $filename;
			$user->save();
		}

		return view('settings', array('user' => Auth::user()));
	}

	public function cart(){
		return view('cart', array('user' => Auth::user()));
	}

	public function order_tracking(){
		return view('Order_Tracking', array('user' => Auth::user()));
	}

	public function see_buyout(){
		return view('see_buyout', array('user' => Auth::user()));
	}

	public function trackings(){
		return view('User-Seller/Tracking/tracking', array('user' => Auth::user()));
	}

	public function products(){
		return view('User-Seller/Products/products2', array('user' => Auth::user()));
	}

	public function buyout(){
		return view('User-Seller/Tracking/see_buyout', array('user' => Auth::user()));	
	}

	public function status(){
		return view('User-Seller/Tracking/manage_status', array('user' => Auth::user()));
	}

	public function change_status(Request $request){
		
		$status = $request->get('status');
		$id = $request->input('id');		
		DB::update("update buyout set status = '$status' where id = '$id'");

		return view('User-Seller/Tracking/tracking',array('user' => Auth::user()));
	}

	public function addproduct(){
		return view('User-Seller/Products/addproduct', array('user' => Auth::user()));
	}

	public function add_product(Request $request){
		$image = $request->file('pImage');
		$filename = time() . '.' . $image->getClientOriginalExtension();
		Image::make($image)->resize(300, 300)->save( public_path('products/' . $filename));
		$name = $request->input('pName');
		$description = $request->input('pDescription');
		$quantity = $request->input('pQuantity');
		$price = $request->input('pPrice');
		$category = $request->get('pCategory');
		$id = $request->input('id');
		DB::insert("insert into products (product, description, quantity, price, image, idCategory, idUser) values ('$name', '$description', '$quantity', '$price', '$filename', '$category', '$id')");

		return view('User-Seller/Products/products2', array('user' => Auth::user()));
	}

	public function updateproduct(){
		return view('User-Seller/Products/updateProduct', array('user' => Auth::user()));
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

		return redirect()->action('UserController@products', array('user' => Auth::user()));

	}

	public function display(){
		return view('User-Seller/Products/displayProductOn');
	}

	public function hide(){
		return view('User-Seller/Products/displayProductOff');
	}

	public function delete(){
		return view('User-Seller/Products/deleteProduct');
	}

	public function delete_product(Request $request){
		$id = $request->input('id');
		DB::delete("delete from products where idProduct = '$id'");
		return redirect()->action('UserController@products', array('user' => Auth::user()));	
	}

	public function dashboard(){
		return view('User-Seller/dashboard');
	}
}
