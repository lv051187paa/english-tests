import baseApi from "./base.js";

export const login = (data) => baseApi.post('./login', data);
export const logout = () => baseApi.post('./logout');
