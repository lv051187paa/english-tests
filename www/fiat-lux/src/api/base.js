import axios from "axios";

const baseApi = axios.create({
  baseURL: 'http://localhost:8000/api'
});

baseApi.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');

    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
      return config;
    }

    return config;
  },
  (error) => {
    Promise.reject(error)
  });

baseApi.interceptors.response.use(function (response) {
  // Any status code that lie within the range of 2xx cause this function to trigger
  // Do something with response data
  return response;
}, function (error) {
  // Any status codes that falls outside the range of 2xx cause this function to trigger
  // Do something with response error
  if(error.response.status === 401) {
    localStorage.removeItem('token');
    location.href = "/login";
  }
  return Promise.reject(error);
});

export default baseApi;
