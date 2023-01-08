import baseApi from "./base.js";

const TEST_GROUPS_URL = '/test-groups';

export const addTestGroup = (data) => baseApi.post(TEST_GROUPS_URL, data);
export const getTestGroups = () => baseApi.get(TEST_GROUPS_URL);
