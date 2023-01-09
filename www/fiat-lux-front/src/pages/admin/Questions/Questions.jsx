import React, {useEffect, useState} from 'react';
import PropTypes from 'prop-types';
import { getQuestionList, getQuestionListByGroupId } from "../../../api/questions.js";
import {Button, Col, Row, Spin, Table, Typography} from "antd";

import AddOptionModal from "../../../components/modals/AddOptionModal/AddOptionModal.jsx";
import OptionList from "../../../components/OptionList";

import "./questions.css"
import EditTestModal from "../../../components/modals/EditTestModal/index.js";
import AddQuestionModal from "../../../components/modals/AddQuestionModal/index.js";
import EditableRow from "../../../components/tableComponents/EditableRow.jsx";
import EditableTextCell from "../../../components/tableComponents/EditableTextCell/index.js";
import { useParams } from "react-router-dom";

const Questions = () => {
  const [testList, setTestList] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [isTestModalOpen, setIsTestModalOpen] = useState(false);
  const [isOptionModalOpen, setIsOptionModalOpen] = useState(false);
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [selectedTestId, setSelectedTestId] = useState(null);

  const handleOptionModalOpen = (testId) => {
    setIsOptionModalOpen(true)
    setSelectedTestId(testId);
  }

  const handleOptionModalClose = () => {
    setIsOptionModalOpen(false)
    setSelectedTestId(null);
  }

  const handleOptionCreated = (data) => {
    setIsLoading(true)
    getQuestionList()
      .then(({ data }) => {
        setTestList(data.tests)
      })
      .finally(() => setIsLoading(false))
  }

  const handleEditOpen = ({ id }) => {
    setIsEditModalOpen(true);
    setSelectedTestId(id);
  }

  const handleEditModalClose = () => {
    setIsEditModalOpen(false);
    setSelectedTestId(null)
  }

  const columns = [
    {
      title: 'Question',
      dataIndex: 'question',
      key: 'question',
      editable: true,
    },
    {
      title: 'Options',
      dataIndex: 'options',
      key: 'options',
      render: (_, original) => <OptionList onOptionModalOpen={handleOptionModalOpen} {...original} />
    },
    {
      title: 'Actions',
      dataIndex: 'operation',
      render: (_, record) =>
        testList.length >= 1 ? (
          <Typography.Link onClick={() => handleEditOpen(record)}>
            Edit
          </Typography.Link>
        ) : null,
    },
  ];
  const { groupId } = useParams();
  const fetchData = groupId ? () => getQuestionListByGroupId(groupId) : getQuestionList

  useEffect(() => {

    fetchData()
      .then(({ data }) => {
        setTestList(data.tests)
      })
      .finally(() => setIsLoading(false))
  }, [])

  const handleAddTest = (test) => {
    setTestList([...testList, { ...test, options: [] }])
  }

  const handleTestUpdate = (test) => {
    const currentTestIndex = testList.findIndex(({ id }) => id === test.id);
    const testsCopy = [...testList];
    testsCopy[currentTestIndex] = test;

    setTestList(testsCopy);

  }

  if(isLoading) {
    return <Spin size="large" />
  }

  return (
    <>
      <Row justify="end">
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

Questions.propTypes = {

};

export default Questions;