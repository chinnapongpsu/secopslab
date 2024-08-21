import {
  Link,
  Redirect
} from "react-router-dom";

import { useState, useEffect } from 'react';
import axios from 'axios';

function AdminAdd() {

	const [hasToken, setHasToken] = useState(true);	
	
	const [eventName, 	setEventName] 	= useState("");
	const [eventDate, 	setEventDate] 	= useState("");
	const [eventPlace,  setEventPlace] 	= useState("");
	
	useEffect (()=>{
			
		if (sessionStorage.getItem('admin_api_token')==null) {
			setHasToken(false);
		}
	}, []);
	
	function sendAdd(){
		axios.post('http://localhost/api/v1/admin_add_event',
				{
					'api_token': sessionStorage.getItem('admin_api_token'),
					'event_name' : eventName,
					'event_datetime' : eventDate,
					'event_place' : eventPlace,
					
				}
			).then (
				res=> {	
					
					if (res.data == "Ok") {
							alert("Add Successfully");
					}else {
							alert ("Add Failed");
					}
				}
			);
	}
	
	return (
        <div>
			{!hasToken && <Redirect to="/" /> }
			<h2> เพิ่ม Event E-Sport </h2>
				
			<input type="text" value={eventName} onChange={(e)=>setEventName(e.target.value)}	placeolder="ชื่อเกม E-Sport:" / > 
			<input type="datetime-local" value={eventDate} onChange={(e)=>setEventDate(e.target.value)}	placeolder="วัน-เวลา" / > 
			<input type="text" value={eventPlace}  onChange={(e)=>setEventPlace(e.target.value)} placeolder="สถานที่" / > 
			
			<button class="btn-submit" onClick={()=>{sendAdd()}}> submit </button>
			
		</div>
    );
		
}

export default AdminAdd;