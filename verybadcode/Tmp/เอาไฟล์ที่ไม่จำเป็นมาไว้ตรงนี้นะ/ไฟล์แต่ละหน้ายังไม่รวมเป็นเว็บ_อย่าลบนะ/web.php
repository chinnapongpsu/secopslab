<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/list_event',function() {
    $results = app('db')->select("SELECT * FROM RunningEvent");
    return response()->json($results);
});

$router->post('/add_event', function(Illuminate\Http\Request $request) {
    $event_name = $request->input("event_name");

    $event_datetime = strtotime($request->input("event_datetime"));
    $event_datetime = date( 'Y-m-d H:i:s', $event_datetime);

    $event_place = $request->input("event_place");

    $query = app('db')->insert('INSERT into RunningEvent (EvenName, EvenDate, Place)
                                VALUES (?,?,?)', [$event_name, $event_datetime, $event_place] );
    return "OK";
});

$router->put('/update_event',function(Illuminate\Http\Request $request) {
    $event_id = $request->input("event_id");
    $event_name = $request->input("event_name");

    $event_datetime = strtotime($request->input("event_datetime"));
    $event_datetime = date( 'Y-m-d H:i:s', $event_datetime);

    $event_place = $request->input("event_place");

    $query = app('db')->update('UPDATE RunningEvent SET EvenName=?,EvenDate=?,Place=? 
                                WHERE EvenID=?',
                                        [$event_name,$event_datetime,$event_place,$event_id] );

return "Ok";


});

$router->delete('/delete_event',function(Illuminate\Http\Request $request) {

    $event_id = $request->input("event_id");

    $query = app('db')->delete('DELETE FROM RunningEvent WHERE EvenID=?',
                                    [$event_id] );
    return "Ok";
}); 

$router->post('/register_runner',function(Illuminate\Http\Request $request) {

    $event_id = $request->input("event_id");
    $runner_name = $request->input("runner_name");
    $runner_surname = $request->input("runner_surname");
    $runner_distance = $request->input("runner_distance");

    $query = app('db')->insert('INSERT into RunnerRegistration (EventID, Name, Surname, Distance, ConfirmRegister)
                                VALUES (?, ?, ?, ?, ?)',
                                [ $event_id,
                                $runner_name,
                                $runner_surname,
                                $runner_distance,
                                'n' ] );
     return "Ok";
});

$router-> get('/list_runner',function() {
    $results = app ('db')->select("SELECT   RegID,
                                            Name,
                                            Surname,
                                            Distance,
                                            RunningEvent.EvenName,
                                            ConfirmRegister
                                        FROM RunningEvent, RunnerRegistration
                                        WHERE RunningEvent.EvenID = RunnerRegistration.EventID");
            
    return response()->json($results);
});

$router->get('/list_runner/{event_id}',function($event_id) {
    $results = app ('db')->select("SELECT   RegID,
                                            Name,
                                            Surname,
                                            Distance,
                                            RunningEvent.EvenName,
                                            ConfirmRegister
                                        FROM RunningEvent, RunnerRegistration
                                        WHERE (RunningEvent.EvenID = RunnerRegistration.EventID)
                                        AND (RunningEvent.EvenID = ?)",
                                        [$event_id]);
                            
    return response()->json($results);
});
