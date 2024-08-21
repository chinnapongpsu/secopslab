import {
  Link,
  Redirect
} from "react-router-dom";

import Signup from './Signup';
import { useState, useEffect } from 'react';
import axios from 'axios';

function NewUser() {
    return (
        <Link to="/Signup" style={{ textDecoration: 'none' }}> Register </Link> 
        
    );
    
}

export default NewUser;