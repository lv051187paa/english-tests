import React, {useState} from 'react';
import PropTypes from 'prop-types';
import {Checkbox, Col, Input, Modal, Radio, Row, Space} from "antd";
import {CloseOutlined} from "@ant-design/icons";
import OptionEditForm from "../OptionEditForm/index.js";
import {updateTestOption} from "../../api/tests.js";

const EditTestModal = ({isOpen, onModalClose, test}) => {
  console.log(test)
  if (!test) {
    return null;
  }

  const correctOption = test.options.find(({ is_correct }) => is_correct)
  const [correctOptionId, setCorrectOptionId] = useState(correctOption.id)

  const handleCorrectOptionChange = (optionId) => {
    setCorrectOptionId(optionId)
  }

  const handleOptionSave = (data, optionId) => {
    updateTestOption(test.id, optionId, data)
      .then(({ data }) => {
        console.log(data)
      })
  }

  return (
    <Modal title="Edit test options" open={isOpen} onCancel={onModalClose} footer={[]}>
      <h3>{test.question}</h3>
      <Space direction="vertical" size="middle" style={{ display: 'flex' }}>
        {test.options.map((option) => (
          <OptionEditForm
            key={option.id}
            option={option}
            testId={test.id}
            correctOptionId={correctOptionId}
            onCorrectStateChange={handleCorrectOptionChange}
            onOptionBlur={handleOptionSave}
          />
        ))}
      </Space>
    </Modal>
  );
};

EditTestModal.propTypes = {};

export default EditTestModal;
