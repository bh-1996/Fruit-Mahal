<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\File;
 use validate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function Index()
    {
        $product=Category::paginate(6);
        $user=User::all();
        //dd($product);
        return view('index')->with(['product'=>$product,'user'=>$user]);
    }

    public function Fruit()
    {
        $product=Category::paginate(6);
        //dd($product);
        return view('fruit',compact('product'));
    }
    public function Blog()
    {
        return view('blog');
    }
    public function Contact()
    {
        return view('contact');
    }
    public function About()
    {
        return view('about');
    }
    public function Login()
    {
        return view('login');
    }
    public function Review()
    {
        return view('review');
    }
    public function Signup()
    {
        $countries['countries'] = Country::all();
        // $states = DB::table('states')->pluck("name","id");
        return view('signup',$countries);
    }

    public function Profile($id)
    {

        $user=User::find($id);
        return view('myprofile',compact('user'));
    }
    public function ProfileEdit($id)
    {
        $user=User::find($id);
        return view('profile-edit',compact('user'));
    }
    public function userUpdate(Request $req){

        $user=User::find($req->id);
        //dd($user); die;
        $user->full_name = $req->full_name;
        $user->class = $req->class;
        $user->address = $req->address;
        $user->subject = $req->subject;
        $user->state = $req->state;
        $user->country = $req->country;
        $user->zip_code = $req->zip_code;
        if($req->hasfile('images'))
        {
            $destination='addimage/'.$user->images;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file =$req->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('addimage/',$filename);
            $user->images=$filename;

        }
            $user->update();
            return redirect()->back()->with('Success','User Data updateted successfully..!');

    }
    public function userDelete($id)
    {
        $user=User::find($id);
        $user->delete();
        Toastr::Success('User Remove Successfully..!','Success');
        return redirect()->back();
    }
    public function userList()
    {
        if (Auth::user()->user_type == 'T') {
        $user=User::all();
        return view('user_list',compact('user'));
    }else{
        Toastr::error('Something is wrong..?','error');
        abort(404);
        }
    }
    // User data function start
    public function saveUser(Request $req)
    {
        $user=$req->validate([
            'full_name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|string',
            'cpass'  => 'required|same:password',
            'address'   => 'min:3 | max:50',
            'zip_code'  => 'required | min:2 | max:6',
            'images' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password=bcrypt($req-> input('password'));
        $user->class = $req->class;
        $user->user_type = $req->user_type;
        $user->address = $req->address;
        $user->subject = $req->subject;
        $user->state = $req->state;
        $user->country = $req->country;
        $user->zip_code = $req->zip_code;

        if($req->hasfile('images')) {
            $file =$req->file('images');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('addimage/',$filename);
            $user->images=$filename;
        }

        if($user->save()){
            return redirect()->route('signup.post')->with('success','User registration successfully..!');
        }
        Toastr::error('Something is wrong..?','error');
        return back();
    }

    public function LogUser(Request $req)
    {

        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials=$req->only('email','password');

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            Toastr::success('You are login successfully..!','Success');
            return redirect()->route('index.post',Auth::user()->id);
        }
        Toastr::error('You have enter wrong user name or password..? Please enter valid user..?','error');
        return back();
    }
    public function logOut(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();

        $req->session()->regenerateToken();
        Toastr::warning('Session loged out..!','warning');
        return redirect()->route('login.post');
    }
    public function ImageUploadd()
    {
        return view('imageupload');
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get();
        return response()->json($data);
    }
}
