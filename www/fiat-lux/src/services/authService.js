import {login, logout} from "../api/auth.js";

export const authService = {
  isAuthenticated: false,
  signIn: (credentials, callback) => {
    login(credentials)
      .then(({ data }) => {
        localStorage.setItem("token", data.access_token);
        authService.isAuthenticated = true;
        callback(data.access_token);
      })
  },
  signOut: callback => {
    logout()
      .then(() => {
        localStorage.removeItem("token")
        authService.isAuthenticated = false;
        callback();
      })
  }
}
