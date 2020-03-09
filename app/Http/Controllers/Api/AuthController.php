<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use App\User;
use App\Country;
use Illuminate\Database\Eloquent\Builder;
class AuthController extends Controller
{
    /*---------------------------------start of login request--------------------------------------*/
   public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password'=> 'required'
        ];
        $validator = Validator::make(request()->all(),$rules);
        if($validator->fails()){
            result( 401, $validator->messages(), null);
        }
        else{
                if(auth()->attempt(['email'=>request('email') , 'password'=>request('password'),'status'=>'verified'])){

                    User::where('email',request('email'))->update(['api_token'=>Str::random(60)]);
                    $user = User::where('email',$request->email)->first();
                    if(empty($user->image)){
                        $user_image = null;
                    }
                    else{
                        $user_image = 'http://www.vretech.com/images/users/'.$user->image;
                    }
                    $userdata = [
                        'id' =>$user->id,
                        'name' =>$user->name,
                        'email' =>$user->email,
                        'mobile' =>$user->mobile,
                        'image' => $user_image,
                        'token' =>$user->api_token,
                        'country_name' =>$user->country->country_name,
                        'country_id' =>$user->country->id,
                        'city_name' =>$user->city->city_name,
                        'city_id' =>$user->city->id
                    ];
                    result(200 ,null,$userdata);
                }
                else{
                    result(401);
                }
            }
    }
    /*---------------------------------end of login request--------------------------------------*/
    public function reset(Request $request){
        $rules = [
            'email' => 'required|email|exists:users,email',
            'password'=> 'required|min:6',
        ];

        $validator = Validator::make(request()->all(),$rules);
        $validation_errors = $validator->errors();
        if($validator->fails()){

            result(false,$validation_errors->first(), null);
        }
        else{
            $password = Hash::make($request->password);
            User::where('email',request('email'))->update(['password'=>$password]);
            result(201,null,null);
        }
    }








    public static function sendCode(Request $request){
        //send email with code to user
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];
        $validator = Validator::make(request()->all(),$rules);
        $validation_errors = $validator->errors();
        if($validator->fails()){

            result(401,$validation_errors->first(), null);
        }
        else{
            $email = request('email');
            $verify_code = rand(1000,9000);
            User::where('email',request('email'))->update(['status'=>null,'verify_code'=>$verify_code]);
            $data = [
                'email'=>$email,
                'code'=>$verify_code
            ];
            if(SendEmailController::mail($data) == true){
                result(200 ,null,null);
            }
        }
    }








    public static function verifyCode(Request $request){
        $rules = [
            'email' => 'required|email|exists:users,email',
            'code'=>'required|min:4|max:4'
        ];
        $validator = Validator::make(request()->all(),$rules);
        $validation_errors = $validator->errors();
        if($validator->fails()){

            result(401,$validator->messages(), null);
        }
        else{
            $user_code = User::where('email',request('email'))->first();

            if($user_code->verify_code == request('code')){
                $user = User::where('email',request('email'))->update(['status'=>'verified','verify_code'=>$user_code->verify_code+1]);
                if(empty($user_code->image)){
                    $user_image = null;
                }
                else{
                    $user_image = 'http://www.vretech.com/images/users/'.$user_code->image;
                }
                $data = [
                    'id' =>$user_code->id,
                    'name' =>$user_code->name,
                    'email' =>$user_code->email,
                    'mobile' =>$user_code->mobile,
                    'image' => $user_image,
                    'token' =>$user_code->api_token,
                    'country_name' =>$user_code->country->country_name,
                    'city_name' =>$user_code->city->city_name,
                ];
                result(201,'success request',$data);
            }
            else{
                result(401,null,null);
            }
        }
    }


   /*---------------------------------start of register request--------------------------------------*/
    public function register(Request $request)
    {
        $error ="Request error";
        $success = "success request";
        $user_data = array();
        $rules = [
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:6',
            'mobile'=>'required|numeric',
            'country_id'=>'required|numeric',
            'city_id'=>'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make(request()->all(),$rules);
        $validation_errors = $validator->errors();
        if($validator->fails()){

            result(401,$validation_errors->first(), null);
        }
        else{

            $password = Hash::make($request->password);
            $imageName = time().'.'.$request->image->extension();
            $user = new User;
                $user->name = request('name');
                $user->email = request('email');
                $user->password = $password;
                $user->mobile = request('mobile');
                $user->country_id = request('country_id');
                $user->city_id = request('city_id');
                $user->image = $imageName;
                $user->api_token = Str::random(60);
                $user->created_at = new \DateTime();
                $user->updated_at = new \DateTime();
                $user->verify_code = rand(1000,9000);
                $code = $user->verify_code;
                $user->save();
                $request->image->move('images/users', $imageName);
                $user_id = $user->id;
                if(!empty($user->id)){
                    // AuthController::sendCode($user->email , $user->verify_code);
                    $data = [
                        'email'=>$user->email,
                        'code'=>$user->verify_code
                    ];
                    if(SendEmailController::mail($data) == true){
                        result(200 ,null,null);
                    }
                    else{
                        result(401 , 'sending Email Error', null);
                    }
                }
                else{
                    result(401 , $error ,$user_data);
                }
            }
    }
    /*---------------------------------end of register request--------------------------------------*/
    /*---------------------------------start of profile request--------------------------------------*/
    public function logout(Request $request){
        $error ="Request error";
        $success = "success request";
        $rules = [
            "user_id" =>'required',
            "api_token" => 'required'
        ];
        $validator = Validator::make(request()->all() , $rules);
        if($validator->fails()){
            result(401 , $validator->messages(),null);
        }
        else{
            if(User::where('id',request('user_id'))->update(['api_token'=>null]))
            {
                result(200 , $success,null);
            }
            else{
                result(401, $error, null);
            }
        }
    }


    public function profile(Request $request){
        $error = [
            'message' => 'Request error'
        ];
        $success = [
            'message' => 'success request'
        ];
        $rules = [
            'user_id' =>'required',
            'api_token' =>'required'
        ];
        $validator = Validator::make(request()->all() , $rules);
        if($validator->fails()){

            result(false , $validator->messages(),null);
        }
        else{

            $user = DB::table('users')->where('id',$request->user_id)->first();
            if($user){
            if($user->api_token == $request->api_token){
                if($user->type == 'academy'){
                    //academic section
                    $courses = DB::table('courses')->select('*')
                    ->join('majors','majors.major_id','=','courses.major_id')
                    ->where('user_id', $user->id)->get();
                    foreach($courses as $course){
                        $course_image = "public/courses_images/".$course->course_image;
                        $course->course_image =$course_image;
                        $course->center_name = $user->name;
                    }
                    $coursesObject = [
                        "courses"=>$courses
                    ];
                    result(true , $success , $coursesObject);
                }
                elseif($user->type == "trainee"){
                    //trainee section return trainee details , courses reserved
                    $orders = DB::table('orders')
                    ->select('*')
                    ->join('payments','payments.payment_id','orders.payment_id')
                    ->where('user_id',$user->id)
                    ->get();
                    $data = [
                        "orders"=>$orders
                    ];
                    result(true, $success, $data);
                }
            }else{
                result(false, $error, null);
            }
        }
        else{
            result(false, $error, null);
        }

        }
    }
    public function updatePassword(Request $request){
        $rules = [
            'email' => 'required|email|exists:users,email',
            'oldPassword'=> 'required|min:6',
            'newPassword'=> 'required|min:6'
        ];

        $validator = Validator::make(request()->all(),$rules);
        $validation_errors = $validator->errors();
        if($validator->fails()){

            result(401 , $validation_errors->first(), null);
        }
        else{
            $newPassword = Hash::make($request->newPassword);
            if(auth()->attempt(['email'=>request('email') , 'password'=>request('oldPassword')])){
                User::where('email',request('email'))->update(['password'=>$newPassword]);
                result(200,'success request',null);
            }
            else{
                result(401);
            }
        }
    }

}
