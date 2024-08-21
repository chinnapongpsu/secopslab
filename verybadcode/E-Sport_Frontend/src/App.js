import logo from './logo.svg';
import './style.css';

import  Login from './Login';
import  Signup from './Signup';
import  Homepage from './Homepage';
import  AdminHome from './AdminHome';

import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

function App() {
  return (
    <div className="App">
      <Router>
        <Switch>

          <Route exact path="/">
            <Login />
          </Route>
        
          <Route path="/signup">
            <Signup />
          </Route>

          <Route path="/homepage">
            <Homepage />
          </Route>

          <Route path="/adminhome">
            <AdminHome />
          </Route>

        </Switch>
        
      </Router>
    </div>
  );
}

export default App;