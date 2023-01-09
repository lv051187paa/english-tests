import React from 'react';
import PropTypes from 'prop-types';
import {Form, Input, Modal} from "antd";
import {addQuestion} from "../../../api/questions.js";

const AddQuestionModal = ({ isOpen, onModalClose, onTestCreated, selectedTestGroup }) => {
  const [form] = Form.useForm();

  const submitTest = () => {
    form
      .validateFields()
      .then(({ question }) => {
        form.resetFields();

        addQuestion({ question, test_group_id: selectedTestGroup })
          .then(({ data }) => {
            onTestCreated(data.test);
            onModalClose();
          })
      })
  }

  return (
    <Modal title="Add test question" open={isOpen} onCancel={onModalClose} onOk={submitTest}>
      <Form form={form}>
        <Form.Item
          name="question"
          label="Question text"
          rules={[{ required: true, message: 'Please input the question text' }]}
        >
          <Input.TextArea
            style={{ height: 120, resize: 'none' }}
          />
        </Form.Item>
      </Form>
    </Modal>
  );
};

AddQuestionModal.propTypes = {

};

export default AddQuestionModal;
