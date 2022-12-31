import axios from "axios";

const baseApi = axios.create({
  baseURL: 'http://localhost:8000/api'
});

baseApi.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');

  // if (router.currentRoute.meta?.public) {
  //   return config;
  // }

  if (token) {
    // eslint-disable-next-line no-param-reassign
    config.headers.Authorization = `Bearer ${token}`;
    return config;
  }

  // router.push('/login');

  return config;
},
  (error) => Promise.reject((error)));

export default baseApi;
