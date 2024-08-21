import { useState } from 'react';
import axios from 'axios';

import {
	Redirect
} from "react-router-dom";

function SignUp() {

	const [name, 	setName] 	= useState("");
	const [surname, setSurname] = useState("");
	const [email,  	setEmail] 	= useState("");
	const [username,setUsername]= useState("");
	const [password,  	setPassword] 	= useState("");
	
	const [isSuccess, setIsSuccess] = useState(false);
	function sendSignup(){
			
		if (password == "") {			
			alert ("Enter your password");
		}else{
		
			axios.post('http://localhost/api/v1/register_user',
				{
					"name" : name,
					"surname" : surname,
					"email" : email,
					"username" : username,
					"password" : password,
				}
			).then (
				res=> {	
					
					if (res.data == "Ok") {
							alert("สมัคร สำเร็จ");
							setIsSuccess(true)
					}else {
							alert ("เกิดปัญหา สมัครไม่ได้");
							setIsSuccess(false)
					}
				}
			);
				
		}
		
	}
	
	return (
		<div>
			<h2> Regiter User </h2>
	
			<input type="text" value={name} onChange={(e)=>{setName(e.target.value)}} placeholder="Name" / > <br />
			<input type="text" value={surname} onChange={(e)=>{setSurname(e.target.value)}}	placeholder="Surname" / > <br />
			<input type="text" value={email} onChange={(e)=>{setEmail(e.target.value)}}	placeholder="Email" / > <br />
			<input type="text"  value={username} onChange={(e)=>{setUsername(e.target.value)}} placeholder="Username" / > <br />
			<input type="password"  value={password}	onChange={(e)=>{setPassword(e.target.value)}} placeholder="Password" / > <br />
			
			<button class="btn-submit" onClick={()=>{ sendSignup() }}> submit </button>
			
		    {isSuccess && <Redirect to="/" /> }

		</div>
    );

}

export default SignUp;