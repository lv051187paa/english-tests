import React from 'react';
import PropTypes from 'prop-types';
import {Checkbox, Form, Input, Modal} from "antd";
import {addQuestionOption} from "../../../api/questions.js";

const AddOptionModal = ({ isModalOpen, onModalClose, testId, onOptionCreated }) => {
  const [form] = Form.useForm();

  const submitOption = () => {
    form
      .validateFields()
      .then(({ text, isCorrect }) => {
        form.resetFields();
        addQuestionOption(testId, { text, is_correct: isCorrect })
          .then(({ data }) => {
            onModalClose();
            onOptionCreated(data.option);
          })
          .catch(error => console.error(error))
      })
      .catch((info) => {
        console.log('Validate Failed:', info);
      });

  }
  return (
    <Modal title="Add Option" open={isModalOpen} onOk={submitOption} onCancel={onModalClose}>
      <Form form={form}>
        <Form.Item
          name="text"
          label="Option text"
          rules={[{ required: true, message: 'Please input the option text' }]}
        >
          <Input />
        </Form.Item>
        <Form.Item name="isCorrect" valuePropName="checked" value={false}>
          <Checkbox>Is correct option?</Checkbox>
        </Form.Item>
      </Form>
    </Modal>
  );
};

AddOptionModal.propTypes = {
  isModalOpen: PropTypes.bool,
};

export default AddOptionModal;
