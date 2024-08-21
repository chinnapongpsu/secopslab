<?php



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/list_joke', ['middleware' => 'auth',function () {
	
	$results = app('db')->select("SELECT * FROM informationjoke");
	return response()->json($results);
}]);

$router->post('/add_joke', function(Illuminate\Http\Request $request) {
	
		
		$Joke_name = $request->input("Joke_name");	

		$Joke_Date = strtotime($request->input("Joke_Date"));
		$Joke_Date = date('Y-m-d H:i:s', $Joke_Date);
		
		$Joke_type = $request->input("Joke_type");
		
		$query = app('db')->insert('INSERT into informationjoke
						(JokeName, JokeDate, Joketype)
						VALUE (?, ?, ?)',
						[ $Joke_name,
						  $Joke_Date,
						  $Joke_type ] );
		return "Ok";
	});

$router->put('/update_joke', function(Illuminate\Http\Request $request) {
        
        $Joke_id = $request->input("Joke_id");
        
        $Joke_type = $request->input("Joke_type");
        
        $query = app('db')->update('UPDATE informationjoke
                                    SET Joketype=?
                                    
                                    WHERE
                                        JokeID=?',
                                        [ $Joke_type ,
                                            $Joke_id] );
            
            return "Ok";	
    
     });

     $router->delete('/delete_joke', function(Illuminate\Http\Request $request) {
        
        $Joke_id = $request->input("Joke_id");
           
        $query = app('db')->delete('DELETE FROM informationjoke
                                
                                    WHERE
                                        JokeID=?',
                                        [$Joke_id] );
            
            return "Ok";	
    
     });

     $router->post('/register_joker', ['middleware' => 'auth',function(Illuminate\Http\Request $request) {
	

        $Joke_id = $request->input("Joke_id");

        $user = app('auth')->user();
        $userID = $user->id;
    
        
        $query = app('db')->insert('INSERT into Jokerregistration
                        (JokeID)
                        VALUE (?)',
                        [   $Joke_id,
                            'normal'] );
        return "Ok";
        
    }]);
//แสดงชือเฉพาะคนที่เขียนเรื่อง
    $router->get('/list_joker', function(Illuminate\Http\Request $request) {

         $results = app('db')->select("SELECT Name,Surname,Jokerank,informationjoke.JokeName
                                        FROM Jokerregistration,informationjoke
                                        WHERE Jokerregistration.JokeID = informationjoke.JokeID");

        return response()->json($results);
    });

    $router->get('/list_joker/(JokeID)',function($Joke_id){
        $results = app('db')->select("SELECT Name,Surname,Jokerank,informationjoke.JokeName
        FROM Jokerregistration,informationjoke
        WHERE ( Jokerregistration.JokeID = informationjoke.JokeID)
        AND (Jokerregistration.JokeID = ?)
        AND (user.JokerID = informationjoke.JokeID)",
        [$Joke_id]);

        return response()->json($results);

    });
    

    /*$router->delete('/delete_joker', function(Illuminate\Http\Request $request) {
        
        $Joke_id = $request->input("Joke_id");
           
        $query = app('db')->delete('DELETE FROM jokerregistration
                                
                                    WHERE
                                        JokeID=?',
                                        [$Joke_id] );
            
            return "Ok";	
    
     });
     $router->post('/register',function(Illuminate\Http\Request $request){
    $name = $request->input("name");
    $email =  $request->input("email");
    $username = $request->input("username");
    $password =  app('hash') ->make($request->input("password"));

    $query = app('db')->insert('INSERT into USER(Name,Email,Username,Password)VALUES (?,?,?,?)',
                                    [$name,$email,$username,$password]);

    return "ok"
 });*/


 $router->('/login',function(Illuminate\Http\Request $request){

    $username = $request->input("username");
    $password = $request->input("password");

    $results = app('db')->select('SELECT password form user WHERE Username =?',
    [$username]);

    $loginResult = new stdClass();

    if(count($result)==0){
        $loginResult->status ="fail";
        $loginResult->reason ="User is not founded";

    }else{
        if(app('hash')->check($password,$result[0]->password)){
            $loginResult->status ="success";
        $payload =[
            'iss'=>"joke_system",
            'sub'=>$result[0]->UserID,
            'iat'=>time(),
            'exp'=>time() + 30*60*60,
        ];
        $loginResult->token = JWT:encode($payload,env('APP_KEY'))
        return response()->json($loginResult);
        }else{
            $loginResult->status ="fai;";
        $loginResult->reason ="Incorrect Password";
        return response()->json($loginResult);
        }
    }
    return response()->json($loginResult);

 })

 $router->put ('comfirm_register',['middleware' => 'auth',function(Illuminate\Http\Request $request){
    $reg_id = $request->input("reg_id");

    $user = app('auth')->user();
    $userID = $userID->id;

    $result = app('db')->select("SELECT role FORM user UserId=?",[$userID]);
    if($result[0]->role == 1){

        $query = app ('db') -> insert('UPDATE okerregistration SET confirmregister="y"
        WHERE
        RegID=?',
        [$reg_id]);
        return "ok";
    }else{
        return "Unauthorized, only admin is allowed";
    }



 });