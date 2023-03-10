<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::view('/', function () {
//    return view('welcome');
//});


//parameter catch in order
Route::get("/name/{name?}/{id?}",function ($name= "Jack", $id=123){
    return "Name: ".$name."  IdUser: ".$id;
});


//Not answered
Route::post("/post", function (){
    return "This is POst VIEW";
});


//Where condition in Route
Route::get("/user/{name?}",function ($name="Jack"){
    return "User Name: ".$name;
})->where('name','[A-Za-z]+');

Route::get("/user/{id?}",function ($id="Jack"){
    return "ID User: ".$id;
})->where('name','[0-9]');


//Using Route Condition in RouteServiceProvider to mae global constrain
Route::get("/number/{number?}",function ($id=0){
    return "ID Number: ".$id;
});


//accept "/" in parameter using where
Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');


//Named Route
Route::get('/person/profile', function () {
    return "Person";
})->name('profile');

// Call Route
Route::get("/person/check",function (){
   $curl = route("profile");
   return "URL of person/profile: ".$curl;
});
// Redirect to Name Router
Route::get("/person/check1",function (){
   return  redirect()->route("profile");
});

//Pass Value in to parameter via Named Route
Route::get("/using/{name?}",function ($name="JACK",$id=0){
    echo $_GET["id"]."<br>";
    return "Using: ".$name." And ID: ".$id;
})->name('using');

Route::get("/using1/{name?}/{id?}",function ($name="JACK",$id=0){
    return redirect()->route('using',['id'=>$name,'name'=>$id]);
});


//Group Router: Share attribute to Routes but not  defined again
    // Controller
Route::controller(UserController::class)->group(function () {
    Route::get('/usercontroller', 'index');
    //has parameter
    Route::get('/usercontroller/show/{id}', 'show',["id"=>123]);
});
    // Middleware
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });

    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});
    //Prefixed Route(Group)
Route::prefix('hello')->group(function () {
    Route::get('/bye', function () {
        return "This is hello prefix";
    });
});

//Route Assigned Middleware

// Assigned to Individual Route
Route::get("/catch",function (){
    return "This is Using2";
})->middleware(App\Http\Middleware\AgeMiddleware::class);


Route::post("/post/{id?}",function ($id=2){
   return redirect("/",["id"=>$id]);
});


//Assigned to Route Group
Route::middleware(['using'])->group(function () {
    Route::get('/use1', function () {
        return "This is Use1";
    });

    Route::get('/use2', function () {
        return "This is Use2";
    });
});

Route::get("/",function (Request $request){
    echo $request;
    return view("welcome");
})->middleware('using');


Route::get("/role/{role?}",function ($role1){
    return "This is Role123: ".$role1;
})->middleware('role');


//Route::get("/user123",[UserController::class,'index'])->middleware("role:admin");

Route::get("/user123",[UserController::class,"index"])->middleware("role:guess");


//Using Controller
// Not using Group Route
//Route::get("/home/show",[TestController::class,"show"]);
//
//Route::get('home/index',[TestController::class,'index']);
//
//Route::get('home/index2',[TestController::class,'index2']);

//Using Group Route
Route::controller(TestController::class)->group(function () {
    Route::get('/home/show/{name?}/{id?}', 'show');
    Route::get('/home/index', 'index');
    Route::get('/home/index2', 'index2');
});
Route::middleware('')->group(function (){

});
// Resource Controller
use  \App\Http\Controllers\ResourceController;
//Register Many Resource Controllers
//Route::resources([
//    'photos' => ResourceController::class,
//    'posts' => ResourceController::class,
//]);

//Register 1 Resource Controller
Route::resource('resource',ResourceController::class);


//Nested View
Route::get("/admin",function (){
    return view('admin.view');
});

use Illuminate\Support\Facades\DB;


Route::get("/getusers",function (){
   $arr = DB::select("select * from user ");
//   print_r($arr);
   foreach ($arr as $rows){
       echo "<br>".print_r($rows)."<br>";
   }
   return "<br> This is user: ";
});

use App\Models\Flights;

Route::get('/flights',function (){
    $flights = Flights::all();
    foreach ($flights as $flight){
        echo "<br>".$flight->name;
    }
});
Route::get('/find/{id?}',function($id =0){
    echo "Flight: ".$id;
    $flight=Flights::where('flight_id',$id)->first();
    echo $flight;
});
Route::get('take',function (){
    $flights  = Flights::where("name",'Miss Bethany Strosin MD')
        ->get();
    foreach ($flights as $flight){
        echo "<br>".$flight->name;
    }
});
Route::get("/make",function (){
   $flights=    Flights::factory()
       ->count(2)
       ->make();
    foreach ($flights as $flight){
        echo "<br>".$flight->name;
    }
});

Route::get("/checkage/{id?}",function ($id=100){
    return "he is :".$id;
});

Route::get('/insert',function(){
    $flight=new Flights();
    $flight->name='Nishka';
    $flight->flight_up=date("Y-m-d");
    $flight->save();
});
Route::get('/create',function(){
    Flights::create(['name'=>'Harshita','flight_up'=>date("Y-m-d")]);
});
