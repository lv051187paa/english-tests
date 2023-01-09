import React, { useEffect, useState } from "react";
import PropTypes from "prop-types";
import { Link } from "react-router-dom";
import { Button, Col, List, Row, Spin, Table, Typography } from "antd";

import EditableRow from "../../../components/tableComponents/EditableRow.jsx";
import EditableTextCell from "../../../components/tableComponents/EditableTextCell/index.js";

import { getTestGroups } from "../../../api/testsGroups.js";
import AddTestGroupModal from "../../../components/modals/AddTestGroupModal/index.js";

const Dashboard = props => {
  const [testGroupList, setTestGroupList] = useState([]);
  const [isTestGroupModalOpen, setIsTestGroupModalOpen] = useState(false);
  const [isLoading, setIsLoading] = useState(true);

  const columns = [
    {
      title: "Test Name",
      dataIndex: "group_name",
      key: "group_name",
      editable: true,
      render: (text, original) => <Link to={`/admin/questions/${original.id}`}>{text}</Link>
    },
    {
      title: "Questions count",
      dataIndex: "questions",
      key: "questions",
      render: (_, original) => <span>{original.tests?.length || 0}</span>
    },
    {
      title: "Actions",
      dataIndex: "operation",
      render: (_, record) =>
        testGroupList.length >= 1 ? (
          <Typography.Link>
            Delete
          </Typography.Link>
        ) : null,
    },
  ];

  useEffect(() => {
    getTestGroups()
      .then(({ data }) => {
        setTestGroupList(data.groups);
      })
      .catch(error => console.error(`test groups loading fail: ${error}`))
      .finally(() => setIsLoading(false));
  }, []);

  const handleTestGroupCreated = (testGroup) => {
    setTestGroupList([...testGroupList, testGroup]);
  }

  if (isLoading) {
    return <Spin size="large" />;
  }

  return (
    <>
      <Row justify="end">
        <Col>
          <Button
            type="primary"
            onClick={() => setIsTestGroupModalOpen(true)}
          >
            Add Test
          </Button>
        </Col>
      </Row>
      <Table
        dataSource={testGroupList.map(({ id, ...rest }) => ({ key: id, id, ...rest }))}
        expandable={{
          expandedRowRender: (record) => {
            record.tests.map((test, index) => <div key={index}>{test.question}</div>);

            return (
              <List
                size="small"
                itemLayout="horizontal"
                dataSource={record.tests}
                renderItem={(item) => (
                  <List.Item>
                    {item.question}
                  </List.Item>

                )}
              />
            );
          },
          rowExpandable: (record) => record.name !== "Not Expandable",
        }}
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
              // onTestUpdated: handleTestUpdate,
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
      <AddTestGroupModal
        isOpen={isTestGroupModalOpen}
        onModalClose={() => setIsTestGroupModalOpen(false)}
        onTestGroupCreated={handleTestGroupCreated}
      />
    </>
  );
};

Dashboard.propTypes = {};

export default Dashboard;
