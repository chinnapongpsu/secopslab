import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  Redirect
} from "react-router-dom";

import RegisterEsport from './RegisterEsport';
import ListEvent from './Listevent';
import ProfileUser from './ProfileUser';

import { useState, useEffect } from 'react';

function HomePage(props) {

	const [hasToken, setHasToken] = useState(true);	

	function logout() {
		sessionStorage.clear();
		setHasToken(false);
		alert("Logged Out");
	}
	
	return ( 
	<div> 
		<h1> E-Sport Event </h1>
		
		<Link to="/Homepage/RegisterEsport" class="bar" type="text" style={{ textDecoration: 'none' }}> สมัคร E-Sport </Link> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Link to="/Homepage/RegisterEsport" class="bar" type="text" style={{ textDecoration: 'none' }}>  รายการแข่งของคุณ </Link> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Link to="/Homepage/RegisterEsport" class="bar" type="text" style={{ textDecoration: 'none' }}> ข้อมูลส่วนตัว  </Link> 
        
		<br /><br /><br />
        <button class="btn-submit" onClick={()=>{ logout() }}> Logout </button>  
	
		{!hasToken && <Redirect to="/" /> }
		
		<Switch>
			<Route exact path="/"> 
			</Route>

			<Route path="/homepage/registeresport">
				<RegisterEsport />
			</Route>
			
            <Route path="/homepage/listesport">
				<ListEvent />
			</Route>

            <Route path="/homepage/profileuser">
				<ProfileUser />
			</Route>

		</Switch>
	</div>		
	);

}

export default HomePage;