import React from 'react';
import PropTypes from 'prop-types';
import {
  useLocation,
  Navigate,
} from "react-router-dom";

import {useAuth} from "../../hooks/useAuth.js";

const RequireAuth = ({ children }) => {
  let auth = useAuth();
  let location = useLocation();

  if (!auth.isAuthorized) {
    // Redirect them to the /login page, but save the current location they were
    // trying to go to when they were redirected. This allows us to send them
    // along to that page after they login, which is a nicer user experience
    // than dropping them off on the home page.
    return <Navigate to="/login" state={{ from: location }} replace />;
  }

  return children;
}

RequireAuth.propTypes = {

};

export default RequireAuth;
