import baseApi from "./base.js";

const TESTS_URL = '/tests'

export const getQuestionList = () => baseApi.get(TESTS_URL);
export const getQuestionListByGroupId = (groupId) => baseApi.get(`${TESTS_URL}/group/${groupId}`);
export const addQuestion = (data) => baseApi.post(TESTS_URL, data);
export const updateQuestion = (testId, data) => baseApi.put(`${TESTS_URL}/${testId}`, data);
export const addQuestionOption = (testId, data) => baseApi.post(`${TESTS_URL}/${testId}/options`, data);
export const updateQuestionOption = (testId, optionId, data) => baseApi.put(`${TESTS_URL}/${testId}/options/${optionId}`, data);
