<?php

use Firebase\JWT\JWT ;  


$router->get('/', function () use ($router) {
    return $router->app->version();
});

//แสดง รายชื่อ
$router->get('/list_event', ['middleware' => 'auth',function() {	
            $results = app('db')->select("SELECT * FROM esportevent");
            return response()->json($results);
        }
    ]
);

//เพิ่มข้อมูล Event
$router->post('/add_event', function(Illuminate\Http\Request $request) {
	
		
    $esportevent_name = $request->input("esportevent_name");	

    $esportevent_date = strtotime($request->input("esportevent_date"));
    $esportevent_date = date('Y-m-d H:i:s', $esportevent_date);
    
    $esport_place = $request->input("esport_place");
    
    $query = app('db')->insert('INSERT into esportevent
                    (esportEventName, EsportEventDate, Esportplace)
                    VALUE (?, ?, ?)',
                    [ $esportevent_name,
                      $esportevent_date,
                      $esport_place ] );
    return "Ok";
});

//ใส่ รายชื่องานแข่ง
$router->put('/update_event', function(Illuminate\Http\Request $request) {
        
    $esport_id = $request->input("esport_id");
    
    $esport_place = $request->input("esport_place");
    
    $query = app('db')->update('UPDATE esportevent
                                SET Esportplace=?
                                
                                WHERE
                                    EsportID=?',
                                    [ $esport_place ,
                                        $esport_id] );
        
        return "Ok";	

 });

 //ลบ งานแข่ง
 $router->delete('/delete_event', function(Illuminate\Http\Request $request) {
        
    $esport_id = $request->input("esport_id");
       
    $query = app('db')->delete('DELETE FROM esportevent
                            
                                WHERE
                                    EsportID=?',
                                    [$esport_id] );
        
        return "Ok";	

 });

 //สมัครสมาชิก
 $router->post('/register_user', function(Illuminate\Http\Request $request) {
	
		
    $userid_name = $request->input("userid_name");

    $user_password = $request->input("user_password");

    $user_email = $request->input("user_email");

    $user_name = $request->input("user_name");
    $user_surname = $request->input("user_surname");
    //$user_password = app('hash')->make($request->input("user_password"));

    
    
    $query = app('db')->insert('INSERT into userinformation
                    (Username, Password,Email,Name,Surname)
                    VALUE (?, ?, ?, ?, ?)',
                    [ $userid_name,
                      $user_password,
                      $user_email,
                      $user_name,
                      $user_surname,'n' ] );
    return "Ok";
});



//สมัคร Event
$router->post('/register_event', function(Illuminate\Http\Request $request) {
	

    $esport_id = $request->input("esport_id");

    $user_id = $request->input("user_id");


    $query = app('db')->insert('INSERT into esportregistration
                        (EsportID, UserID)
                        VALUE (?, ?)',
                        [   $esport_id,
                            $user_id, 'n'] );
    
   /* $query = app('db')->select('SELECT esportregistration
                                FROM EsportID=?

                                WHERE 
                                    (userinformation.UserID=?)',
                    [   $esport_id,
                        $user_id,
                        'n'] );*/
    return "Ok";
    
});

/*$router->post('/register_joker', function(Illuminate\Http\Request $request) {
	

    $Joke_id = $request->input("Joke_id");

    $name_jk = $request->input("name_jk");
    $surname_jk = $request->input("surname_jk");

    
    $query = app('db')->insert('INSERT into Jokerregistration
                    (JokeID, Name, Surname)
                    VALUE (?, ?, ?)',
                    [   $Joke_id,
                        $name_jk,
                        $surname_jk,
                        'normal'] );
    return "Ok";
    
});
*/


//แสดงรายชื่อสมาชิก all
$router->get('/list_user', function () {
	
	$results = app('db')->select("SELECT Name,Surname,Email FROM userinformation");
	return response()->json($results);
});


// login แบบเขียนตามแต่ยังไม่เชื่อม
/*$router->get('/list_user', function(Illuminate\Http\Request $request) {

    $results = app('db')->select("SELECT Name,Surname,esportevent.esportEventName
                                   FROM userinformation,esportevent
                                   WHERE userinformation.EsportID = esportevent.EsportID");
  return response()->json($results);
});*/

/*$router->post('/login', function(Illuminate\Http\Request $request){

    $userid_name = $request->input("userid_name");
    $user_password = $request->input("user_password");

    $results = app('db')->select('SELECT Password form user WHERE Username =?',
    [$userid_name]);

    $loginResult = new stdClass();

    if(count($result)==0){
        $loginResult->status ="fail";
        $loginResult->reason ="User is not founded";

    }else{
        if(app('hash')->check($user_password, $result[0]->Password)){
            $loginResult->status ="success";
        $payload =[
            'iss'=>"esport_system",
            'sub'=>$result[0]->Username,
            'iat'=>time(),
            'exp'=>time() + 30*60*60,
        ];
        $loginResult->token = JWT::encode($payload,env('APP_KEY'));
        return response()->json($loginResult);
        }else{
            $loginResult->status ="fai;";
        $loginResult->reason ="Incorrect Password";
        return response()->json($loginResult);
        }
    }
    return response()->json($loginResult);

 });*/
// แบบแรก คือ ไม่ใส่ token
 /*$router->post('/login', function(Illuminate\Http\Request $request){

    $userid_name = $request->input("userid_name");
    $user_password = $request->input("user_password");

    $results = app('db')->select('SELECT Password form userinformation WHERE Username =?',
    [$userid_name]);

    $loginResult = new stdClass();

    if(count( $result) == 0){

        $loginResult->status = "fail";
        $loginResult->reason ="User is not founded";

    }else{
        if ($result[0]->Password)
        {
           
            $loginResult->status ="Success";
            $loginResult->reason ="Welcome";

         return response()->json($loginResult);
        } else {

            $loginResult->status ="fai;";
            $loginResult->reason ="Incorrect Password";

        return response()->json($loginResult);

        }
    }
    return response()->json($loginResult);

 });*/
// login สมบููรณ์
 $router->post('/login', function(Illuminate\Http\Request $request) {
	
	$userid_name = $request->input("userid_name");
	$user_password = $request->input("user_password");
	
	$result = app('db')->select("SELECT UserID, password FROM userinformation WHERE Username=?",
									[$userid_name]);
									
	$loginResult = new stdClass();
	
	if(count ($result) == 0) {
			$loginResult->status = "fail";
			$loginResult->reason = "User is not founded";
	}else {
	
		if(app('hash')->check($user_password, $result[0]->password)){
			$loginResult->status = "success";
			
			$payload = [
				'iss' => "esport_system",
				'sub' => $result[0]->UserID,
				'iat' => time(),
				'exp' => time()+ 30 * 60 * 60,
			
			];
			
			$loginResult->token = JWT::encode($payload, env('APP_KEY'));
			$loginResult->isAdmin = $result[0]->IsAdmin;
			
		}else {
			$loginResult->status = "fail";
			$loginResult->reason = "Incorrect Password";
		}
	}
	return response()->json($loginResult);
});
