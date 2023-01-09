import React, { useEffect, useState } from "react";
import PropTypes from "prop-types";
import { useNavigate, useParams } from "react-router-dom";
import { Button, Col, Row, Select, Spin, Table, Typography } from "antd";

import AddOptionModal from "../../../components/modals/AddOptionModal/AddOptionModal.jsx";
import OptionList from "../../../components/OptionList";
import EditTestModal from "../../../components/modals/EditTestModal/index.js";
import AddQuestionModal from "../../../components/modals/AddQuestionModal/index.js";
import EditableRow from "../../../components/tableComponents/EditableRow.jsx";
import EditableTextCell from "../../../components/tableComponents/EditableTextCell/index.js";

import { getQuestionList, getQuestionListByGroupId } from "../../../api/questions.js";

import "./questions.css";
import { getTestGroups } from "../../../api/testsGroups.js";
import { getTesGroupsSelectOptions } from "./utils.js";

const Questions = () => {
  const { groupId } = useParams();
  const navigate = useNavigate();

  const [testList, setTestList] = useState([]);
  const [testGroupList, setTestGroupList] = useState([]);
  const [selectedGroupId, setSelectedGroupId] = useState(Number(groupId) ?? null)
  const [isLoading, setIsLoading] = useState(true);
  const [isTestModalOpen, setIsTestModalOpen] = useState(false);
  const [isOptionModalOpen, setIsOptionModalOpen] = useState(false);
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [selectedTestId, setSelectedTestId] = useState(null);

  const fetchData = groupId ? () => getQuestionListByGroupId(groupId) : getQuestionList;

  const handleOptionModalOpen = (testId) => {
    setIsOptionModalOpen(true);
    setSelectedTestId(testId);
  };

  const handleOptionModalClose = () => {
    setIsOptionModalOpen(false);
    setSelectedTestId(null);
  };

  const handleOptionCreated = (data) => {
    setIsLoading(true);
    fetchData()
      .then(({ data }) => {
        setTestList(data.tests);
      })
      .finally(() => setIsLoading(false));
  };

  const handleEditOpen = ({ id }) => {
    setIsEditModalOpen(true);
    setSelectedTestId(id);
  };

  const handleEditModalClose = () => {
    setIsEditModalOpen(false);
    setSelectedTestId(null);
  };

  const columns = [
    {
      title: "Question",
      dataIndex: "question",
      key: "question",
      editable: true,
    },
    {
      title: "Options",
      dataIndex: "options",
      key: "options",
      render: (_, original) => <OptionList onOptionModalOpen={handleOptionModalOpen} {...original} />
    },
    {
      title: "Actions",
      dataIndex: "operation",
      render: (_, record) =>
        testList.length >= 1 ? (
          <Typography.Link onClick={() => handleEditOpen(record)}>
            Edit
          </Typography.Link>
        ) : null,
    },
  ];

  useEffect(() => {

    Promise.all([
      fetchData(),
      getTestGroups(),
    ])
      .then(([testsResponse, testGroupsResponse]) => {
        setTestList(testsResponse.data.tests);
        const testGroupsOptions = getTesGroupsSelectOptions(testGroupsResponse.data.groups);
        setTestGroupList(testGroupsOptions);
      })
      .finally(() => setIsLoading(false));
  }, []);

  useEffect(() => {
    navigate(`/admin/questions/${selectedGroupId}`)
    setIsLoading(true);
    getQuestionListByGroupId(selectedGroupId)
      .then(({ data }) => {
        setTestList(data.tests);
      })
      .finally(() => setIsLoading(false))
  }, [selectedGroupId])

  const handleAddTest = (test) => {
    setTestList([...testList, { ...test, options: [] }]);
  };

  const handleTestUpdate = (test) => {
    const currentTestIndex = testList.findIndex(({ id }) => id === test.id);
    const testsCopy = [...testList];
    testsCopy[currentTestIndex] = test;

    setTestList(testsCopy);
  };

  const handleTestGroupChange = (value) => setSelectedGroupId(value)

  if (isLoading) {
    return <Spin size="large" />;
  }

  return (
    <>
      <Row justify="space-between">
        <Col>
          <Select
            style={{
              width: 120,
            }}
            defaultValue={selectedGroupId}
            placeholder="Select a test"
            onChange={handleTestGroupChange}
            options={testGroupList}
          />
        </Col>
        <Col>
          <Button
            type="primary"
            onClick={() => setIsTestModalOpen(true)}
          >
            Add Question
          </Button>
        </Col>
      </Row>
      <Table
        dataSource={testList.map(({ id, ...rest }) => ({ key: id, id, ...rest }))}
        columns={columns.map((col) => {
          if (!col.editable) {
            return col;
          }
          return {
            ...col,
            onCell: (record) => ({
              record,
              editable: col.editable,
              dataIndex: col.dataIndex,
              title: col.title,
              onTestUpdated: handleTestUpdate,
            }),
          };
        })}
        components={{
          body: {
            row: EditableRow,
            cell: EditableTextCell,
          }
        }}
      />
      <AddQuestionModal
        isOpen={isTestModalOpen}
        onModalClose={() => setIsTestModalOpen(false)}
        selectedTestGroup={selectedGroupId}
        onTestCreated={handleAddTest}
      />
      <AddOptionModal
        isModalOpen={isOptionModalOpen}
        onModalClose={handleOptionModalClose}
        testId={selectedTestId}
        onOptionCreated={handleOptionCreated}
      />
      <EditTestModal
        isOpen={isEditModalOpen}
        test={testList.find(({ id }) => id === selectedTestId)}
        onModalClose={handleEditModalClose}
      />
    </>
  );
};

Questions.propTypes = {};

export default Questions;
