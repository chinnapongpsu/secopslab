import {
  Link,
  Redirect
} from "react-router-dom";

import { useState, useEffect } from 'react';
import axios from 'axios';

function ProfileUser(){

	const [name, 	setName] 	= useState("");
	const [surname, setSurname] = useState("");
	const [email,  	setEmail] 	= useState("");
	
	const [hasToken, setHasToken] = useState(true);	
	useEffect (()=>{
		
		
		if (sessionStorage.getItem('user_api_token')==null) {
			setHasToken(false);
		}else {
			axios.get('http://localhost/api/v1/get_user_profile?api_token='+sessionStorage.getItem('user_api_token'),
			).then (
				res=> {	
					setName(res.data[0].Name);
					setSurname(res.data[0].Surname);
					setEmail(res.data[0].Email);
				}
			);
			
		}
	}, []);

	return ( 
	<div>
	
		{!hasToken && <Redirect to="/" /> }
		
		<h2> ข้อมูลส่วนตัวของคุณ </h2>
	
		<h3> ชื่อ {name} นามสกุล {surname} </h3>
	
		<h3> อีเมล์ {email} </h3>
	
	</div>);
	
}

export default ProfileUser;