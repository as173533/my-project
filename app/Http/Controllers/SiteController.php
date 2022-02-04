<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thankyou;
/* * ************Request***************** */
//use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ContactUsRequest;

/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\StaticPage;
use App\Model\Contactus;
use App\Model\Category;
use App\Model\Project;
use App\Model\Settings;

class SiteController extends Controller {

    public function index() {
        if (Auth()->guard('frontend')->guest()){
        return view('site.login');
        }else{
        return redirect()->route('projects');
        }
    }
    public function projects() {
        $data=[];
        $data['projects']=Project::where('status','1')->get();
        return view('site.project',$data);
    }
    public function get_project_details($id) {
        $data = [];
        $data['project_detail'] = $details = Project::findOrFail(base64_decode($id));
        if (!$details) {
            return redirect()->route('/')->with('error_msg', 'Something went wrong please check your input!');
        }
        return view('site.project_detail', $data);
    }

   

    function imageUpload($image) {
        $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user/');
        $image->move($destinationPath, $name);
        return $name;
    }

   

    public function get_login() {
        return view('site.login');
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->only('email');
            $model = UserMaster::where('email', '=', $input['email'])->first();
            if (!empty($request->input('rememberMe'))) {
                $expire = time() + 172800;
                setcookie('user_email', $request->input('email'), $expire, '/');
                setcookie('user_password', $request->input('password'), $expire, '/');
            } else {
                $expire = time() - 172800;
                setcookie('user_email', '', $expire, '/');
                setcookie('user_password', '', $expire, '/');
            }
            Auth::guard('frontend')->login($model);
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
            $data_msg['link'] = Route('projects');

            $request->session()->flash('success', 'You are successfully logged in.');
            return response()->json($data_msg);
        }
    }

    

    public function get_static_page(Request $request) {
        $data = [];
        if ($request->route()->named('about-us')) {
            $data['model'] = StaticPage::where('slug', '=', 'about_us')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('privacy-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'privacy_policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('return-refund-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'return-refund-policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('terms-condition')) {
            $data['model'] = StaticPage::where('slug', '=', 'terms_conditions')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('faq-page')) {
            $data['model'] = Faq::where('status', '=', '1')->get();
            return view('site.faq', $data);
        } else {
            return redirect()->route('/');
        }
    }

    public function get_contactus() {
        $data = [];
        $data['model'] = Settings::where('module', '=', 'Location')->get();
        return view('site.contact_us', $data);
    }

    public function post_contact(ContactUsRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Contactus::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => 'albert@yopmail.com',
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }

    
    
    public function blogarchive(Request $request,$slug)
    {
        
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
            
        return view('site.blog',compact('blogs','date'));
    }
    public function blogsearch(Request $request)
    {
        
        $search = $request->search;
        $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate(9);
            
        return view('site.blog',compact('blogs','search'));
    }
  	
  	public function autocomplete(Request $request)
    {
      	
      	$search = $request->input('search');
        $datas = Blog::select("title")->where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->get();
   		
      	$response = array();
      foreach($datas as $data){
         $response[] = array("value"=>$data->title,"label"=>$data->title);
      }

      return response()->json($response);
    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

}
