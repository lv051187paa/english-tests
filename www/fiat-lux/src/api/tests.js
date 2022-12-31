import baseApi from "./base.js";

export const getTestList = () => baseApi.get('/tests');
export const addTestOption = (testId, data) => baseApi.post(`/tests/${testId}/options`, data)
export const updateTestOption = (testId, optionId, data) => baseApi.put(`/tests/${testId}/options/${optionId}`, data)
