import React, {useEffect, useState} from 'react';
import PropTypes from 'prop-types';
import {getTestList} from "../../../api/tests.js";
import {Spin, Table, Typography} from "antd";

import AddOptionModal from "../../../components/AddOptionModal/AddOptionModal.jsx";
import OptionList from "../../../components/OptionList";

import "./dashboard.css"
import EditTestModal from "../../../components/EditTestModal/index.js";

const Dashboard = () => {
  const [testList, setTestList] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
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
    getTestList()
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
    },
    {
      title: 'Options',
      dataIndex: 'options',
      key: 'options',
      render: (_, original) => <OptionList onOptionModalOpen={handleOptionModalOpen} {...original} />
    },
    {
      title: 'operation',
      dataIndex: 'operation',
      render: (_, record) =>
        testList.length >= 1 ? (
          <Typography.Link onClick={() => handleEditOpen(record)}>
            Edit
          </Typography.Link>
        ) : null,
    },
  ];

  useEffect(() => {
    getTestList()
      .then(({ data }) => {
        setTestList(data.tests)
      })
      .finally(() => setIsLoading(false))
  }, [])

  if(isLoading) {
    return <Spin size="large" />
  }

  return (
    <>
      <Table dataSource={testList.map(({ id, ...rest }) => ({ key: id, id, ...rest }))} columns={columns} />
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

Dashboard.propTypes = {

};

export default Dashboard;
