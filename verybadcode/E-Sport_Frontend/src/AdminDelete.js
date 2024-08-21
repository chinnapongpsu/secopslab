import {
  Link,
  Redirect
} from "react-router-dom";

import AdminAdd from './AdminAdd';

import { useState, useEffect } from 'react';
import axios from 'axios';

function AdminDelete() {

	const [hasToken, setHasToken] = useState(true);	
	
	const [eventName, 	setEventName] 	= useState("");
	const [eventDate, 	setEventDate] 	= useState("");
	const [eventPlace,  setEventPlace] 	= useState("");
	
	useEffect (()=>{
			
		if (sessionStorage.getItem('admin_api_token')==null) {
			setHasToken(false);
		}
	}, []);
	
	function sendDelete(){
		axios.delete('http://localhost/api/v1/admin_delete_event',
				{
					'api_token': sessionStorage.getItem('admin_api_token'),
					'event_name' : eventName,
					'event_datetime' : eventDate,
					'event_place' : eventPlace,
					
				}
			).then (
				res=> {	
					
					if (res.data == "Ok") {
							alert("Delete Successfully");
					}else {
							alert ("Delete Failed");
					}
				}
			);
	}
	
	return (
        <div>
			{!hasToken && <Redirect to="/" /> }
			<h2> ลบรายการ Event E-Sport </h2>
				
			{(eventItem => (
				<h4> - รายชื่อเกม E-Sport:{eventItem[0]} สถานที่:{eventItem[1]}  วัน-เวลา: {eventItem[2]} , สถานะการยืนยันการสมัคร:{eventItem[3]} </h4>
		    ))}
			
			<button onClick={()=>{sendDelete()}}> submit </button>
			
		</div>
    );
		
}

export default AdminDelete;