import {
  Link,
  Redirect
} from "react-router-dom";


import { useState, useEffect } from 'react';
import axios from 'axios';

function RegisterEsport(){
	
	
	const [hasToken, setHasToken] = useState(true);	
	const [eventList, setEventList] = useState([]);


	useEffect (()=>{
			
		if (sessionStorage.getItem('user_api_token')==null) {
			setHasToken(false);
		}
	}, []);
	
	
	function sendSignup(eventID){
		axios.post('http://localhost/api/v1/register_event',
				{
					'api_token': sessionStorage.getItem('user_api_token'),
					'event_id' : eventID,
				}
			).then (
				res=> {	
					
					if (res.data == "Ok") {
							alert("Register Successfully");
					}else {
							alert ("Register Failed");
					}
				}
			);
	}
	useEffect (()=>{
		
		if (sessionStorage.getItem('user_api_token')==null) {
			setHasToken(false);
		}else {
			axios.get('http://localhost/api/v1/list_all_event',
			).then (
				res=> {	
						let item_list = [];
						for(let i = 0;i < res.data.length;i++){
							item_list[i] = [ res.data[i].EventID, res.data[i].EventName, res.data[i].EventPlace, res.data[i].EventDate]; 
						}
						setEventList(item_list);
				}
			);	
		}
	}, []);
	
	
	return (
		<div>
			<h2> สมัคร E-Sport </h2>
			<h3> กดปุ่ม สมัคร เพื่อสมัครงาน </h3>
			
			{!hasToken && <Redirect to="/" /> }
			{eventList.map(eventItem => (
				<h4> 
					{eventItem[0]}: ชื่อเกม E-Sport:{eventItem[1]} สถานที่:{eventItem[2]} วัน-เวลา: {eventItem[3]}  
				
					<button onClick={()=>{ sendSignup(eventItem[0]) }} > สมัคร </button> 
				
				</h4>
			))}
			
		</div>
	
	);
}

export default RegisterEsport;