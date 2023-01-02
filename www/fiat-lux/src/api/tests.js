import baseApi from "./base.js";

export const getTestList = () => baseApi.get("/tests");
export const addTest = (data) => baseApi.post("/tests", data);
export const updateTest = (testId, data) => baseApi.put(`/tests/${testId}`, data);
export const addTestOption = (testId, data) => baseApi.post(`/tests/${testId}/options`, data);
export const updateTestOption = (testId, optionId, data) => baseApi.put(`/tests/${testId}/options/${optionId}`, data);
