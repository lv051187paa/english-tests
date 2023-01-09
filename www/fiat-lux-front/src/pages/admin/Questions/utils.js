export const getTesGroupsSelectOptions = (testGroups) => {
  return testGroups.map(({ id, group_name }) => {
    return {
      value: id,
      label: group_name,
    }
  })
}
