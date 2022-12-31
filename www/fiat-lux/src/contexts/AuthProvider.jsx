import { createContext, useState, useEffect } from 'react';
import {authService} from "../services/authService.js";
import {useLocation, useNavigate} from "react-router-dom";

export const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  let [isAuthorized, setIsAuthorized] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem("token");
    setIsAuthorized(!!token);
  }, []);

  const signin = ({ email, password }, callback) => {
    return authService.signIn({ email, password }, (token) => {
      setIsAuthorized(!!token);
      setTimeout(callback)
    });
  };

  const signout = (callback) => {
    return authService.signOut(() => {
      setIsAuthorized(false);
      setTimeout(callback)
    });
  };

  let value = { isAuthorized, signin, signout };

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export default AuthProvider;
