import React from "react";
import PropTypes from "prop-types";
import { Checkbox, Form, Input, Modal } from "antd";
import { addTestGroup } from "../../../api/testsGroups.js";

const AddTestGroupModal = ({ isOpen, onTestGroupCreated, onModalClose }) => {
  const [form] = Form.useForm();

  const submitTestGroup = () => {
    form
      .validateFields()
      .then(({ text }) => {
        form.resetFields();
        addTestGroup({ group_name: text })
          .then(({ data }) => {
            onTestGroupCreated(data.group)
            onModalClose();
          })
          .catch(error => console.error(error))
      })
      .catch(error => console.error(error))
  }

  return (
    <Modal title="Add Test" open={isOpen} onOk={submitTestGroup} onCancel={onModalClose}>
      <Form form={form}>
        <Form.Item
          name="text"
          label="Test Name"
          rules={[{ required: true, message: 'Please input the Test name' }]}
        >
          <Input autoFocus />
        </Form.Item>
      </Form>
    </Modal>
  );
};

AddTestGroupModal.propTypes = {

};

export default AddTestGroupModal;
