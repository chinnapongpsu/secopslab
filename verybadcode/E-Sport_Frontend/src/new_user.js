import {
  Link,
  Redirect
} from "react-router-dom";

import SignUp from 'SignUp';
import { useState, useEffect } from 'react';
import axios from 'axios';

function NewUser() {
    return (
        <input type="text" value="Signup" onClick={()=>{sendSignup()}} / > 
        คุณยังไม่ได้เคยใช้งานเว็บนี้ กดที่นี่เพื่อสมัคร
    );
    
}

export default NewUser;