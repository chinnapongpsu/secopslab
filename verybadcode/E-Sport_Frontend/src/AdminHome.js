import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  Redirect
} from "react-router-dom";

import AdminAdd from './AdminAdd';
import AdminDelete from './AdminDelete';

import { useState, useEffect } from 'react';

function AdminHome() {
	
	const [hasToken, setHasToken] = useState(true);	

	function logout() {
		
		sessionStorage.clear();
		setHasToken(false);
		alert("Logged Out");
	}
	return (<div>
	
	    <h1> Admin E-Sport Event </h1>

		<Link to="/admin/addevent" class="bar" style={{ textDecoration: 'none' }}> เพิ่มงานวิ่ง </Link> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Link to="/admin/delete" class="bar" style={{ textDecoration: 'none' }}>  ลบผู้สมัคร </Link>   
		
        <br /><br /><br />
        <button class="btn-submit" onClick={ ()=>{logout()}}> Logout </button>

		{!hasToken && <Redirect to="/" /> }
		
			<Switch>
				<Route path="/admin/addevent/">
					<AdminAdd />
				</Route>
				
				<Route path="/admin/adddelete/">
					<AdminDelete />
				</Route>
				
			</Switch>
				
	</div>)

}
export default AdminHome;