<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ManageproductController extends Controller
{
    //
    public function productPage()
    {
        return view('manage');
    }
    public function FruitsMahal(Request $request)
    {

        if ($request->has('search')) {
            $product = Category::where("title", "LIKE", "%{$request->search}%")->get();

        } else {
            $product = Category::all();
        }




        return view('fruits_mahal', compact('product'));
    }

    // public function Profile($id)
    // {

    //     $user=User::find($id);
    //     return view('myprofile',compact('user'));
    // }
    public function productList()
    {
        $product = Category::all();
        return view('productlist', compact('product'));
    }
    public function productEdit($id)
    {
        
        return view('edit_product', compact('product'));
    }
    public function productUpdate(Request $req)
    {
        $product = $req->validate([
            'title' => 'required|min:3|max:20',
            'description' => 'required',
            'price'   =>  'required|integer|min:0',
            'image' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);


        $product = Category::find($req->id);

        $product->title = $req->title;
        $product->description = $req->description;
        $product->price = $req->price;
        if ($req->hasfile('image')) {
            $destination = 'product_img/' . $product->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $req->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('product_img/', $filename);
            $product->image = $filename;
        }
        $product->update();
        Toastr::success('product Data updateted successfully..!','Success');
        return redirect()->back();
    }
    //change Status
    public function productStatus(Request $req)
    {
        $product = Category::find($req->user_id);
        $product->status = $req->status;
        $product->save();

        return response()->json(['success' => 'product status change successfully.']);
    }
    public function productDelete($id)
    {
        $product = Category::find($id);
        $product->delete();
        Toastr::success('product Deleted successfully..!','Success');
        return redirect()->back();
    }


    // User data function start
    public function productAdd(Request $req)
    {
        $product = $req->validate([
            // 'title' => 'required|min:3|max:20',
            // 'description' => 'required',
            // 'price'   =>  'required|integer|min:1',
            // 'image' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        $product = new Category();
        $product->user_id = Auth::user()->id;
        $product->title = $req->title;
        $product->description = $req->description;
        $product->price = $req->price;
        // $product->user_id =$req->user_id(auth()->id());

        if ($req->hasfile('image')) {
            $file = $req->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('product_img/', $filename);
            $product->image = $filename;
        }

        if ($product->save()) {
            Toastr::success('product added successfully..!','Success');
            return redirect()->route('product.page');
        }
        // ->with('success', 'Product added successfully..!')
        return back();
    }
    public function searchCategory(Request $request)
    {
        $categories = Category::select("title")
            ->where("title", "LIKE", "%{$request->search}%")
            ->pluck('title');

        // return json_encode($categories);

        return response()->json($categories);
    }
    public function dataTable()
    {
        if(request()->ajax()) {
            return datatables()->of(Category::select('*'))
            ->addColumn('action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('productlist');
    }

    public function viewProduct($id)
    {
        $product=Category::find($id);
        //dd($product);
        return view('view_product',compact('product'));
    }

    public function cart()
    {
        return view('cart');
    }
    public function products()
    {
        $products = Category::all();
        return view('products', compact('products'));
    }

    public function addToCart($id)

    {
        $product = Category::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        Toastr::success('Product added to cart successfully..!','Success');
        return redirect()->back();
    }
    public function updateQuantity(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    //Check out delivery
    public function deliveryDetails()
    {
        $countries['countries'] = Country::all();
        // $states = DB::table('states')->pluck("name","id");
        return view('delivery',$countries);
    }

    public function saveDeliveryAddress(Request $req)
    {
        $address = $req->validate([
            // 'full_name' => 'required|min:3|max:20',
            // 'description' => 'required',
            // 'price'   =>  'required|integer|min:1',
            // 'image' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        $address=new Delivery();
        $address->user_id = Auth::user()->id;
        $address->address_type = $req->address_type;
        $address->full_name = $req->full_name;
        $address->address = $req->address;
        $address->phone = $req->phone;
        $address->country = $req->country;
        $address->state = $req->state;
        $address->city = $req->city;
        $address->zip_code = $req->zip_code;

        if ($address->save()) {
            Toastr::success('Address saved successfully..!','Success');
            return redirect()->back();
        }
        Toastr::error('Something is wrong..?','error');
        return back();
    }
}
