import {
  Link,
  Redirect
} from "react-router-dom";

import './style.css';
import { useState, useEffect } from 'react';
import axios from 'axios';


function Homepage() {
	
	const [username, setUsername] = useState("");
	const [password, setPassword] = useState("");
	const [isLoggedInToMember, setIsLoggedInToMember] = useState(false);
	const [isLoggedInToAdmin,  setIsLoggedInToAdmin] =  useState(false);
	
	
	useEffect (()=>{
		if (sessionStorage.getItem('user_api_token')!=null) {
			setIsLoggedInToMember(false);
		}
		
		if (sessionStorage.getItem('admin_api_token')!=null) {
			setIsLoggedInToAdmin(false);
		}
	
	}, []);
	
	function sendLogin(){	
	
			axios.post('http://localhost/api/v1/login',
				{
					"username" : username,
					"password" : password,
				}
			).then (
				res=> {				
					if (res.data.status=="success"){				
						if ( res.data.isAdmin == 'n'){
							setIsLoggedInToMember(true);
							sessionStorage.setItem('user_api_token', res.data.token);
						}else{
							setIsLoggedInToAdmin(true);
							sessionStorage.setItem('admin_api_token', res.data.token);
						}
					}else {
						alert ("Login Failed!!");
					}
				}
			);	
	}
	
	return (
		<div class="container">
			<div class="login">
				
				<h1> E-Sport Tournament </h1> <br />
				<h2> SignUp </h2>
			
				<input class="text" type="text" onChange={(e)=>{setUsername(e.target.value)}} placeholder="Username" / > <br />
				<input class="text" type="password" onChange={(e)=>{setPassword(e.target.value)}} placeholder="password" / > 
				<br />
				<Link to="/Signup" class="register" style={{ textDecoration: 'none' }}> Register </Link>
				<br /><br />
				<button class="btn-submit" onClick={()=>{ sendLogin() }} > Login </button>
				

	 
				{isLoggedInToMember && <Redirect to="/member" /> }
				{isLoggedInToAdmin &&  <Redirect to="/admin" /> }

			</div>
		</div>
	);
}

export default Homepage;