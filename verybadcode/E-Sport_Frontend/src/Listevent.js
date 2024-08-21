import {
  Link,
  Redirect
} from "react-router-dom";

import { useState, useEffect } from 'react';
import axios from 'axios';

function ListEvent(){

	const [hasToken, setHasToken] = useState(true);	
	const [eventList, setEventList] = useState([]);
	useEffect (()=>{
		
		if (sessionStorage.getItem('user_api_token')==null) {
			setHasToken(false);
		}else {
			axios.get('http://localhost/api/v1/list_user_event?api_token='+sessionStorage.getItem('user_api_token'),
			).then (
				res=> {	
						let item_list = [];
						for(let i = 0;i < res.data.length;i++){
							item_list[i] = [ res.data[i].EventName, res.data[i].EventPlace, res.data[i].EventDate, res.data[i].Confirm ]; 
						}
						
						setEventList(item_list);
						
				}
			
			);
			
		}
	}, []);
	
	
	return ( 
	<div>
	
		<h2>  รายการ E-Sport ของคุณ </h2>
	
		 {eventList.map(eventItem => (
				<h4> - รายชื่อเกม E-Sport:{eventItem[0]} สถานที่:{eventItem[1]}  วัน-เวลา: {eventItem[2]} , สถานะการยืนยันการสมัคร:{eventItem[3]} </h4>
		  ))}
	  
	</div>);
	
}

export default ListEvent;