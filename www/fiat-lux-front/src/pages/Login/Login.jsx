import React from 'react';
import PropTypes from 'prop-types';

import "./login.css"

import LoginForm from "../../components/LoginForm/index.js";

const Login = props => {
    return (
      <div className="login-page">
        <LoginForm />
      </div>
    );
};

Login.propTypes = {

};

export default Login;
