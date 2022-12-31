import React, {useState} from 'react';
import PropTypes from 'prop-types';
import {Col, Input, Radio, Row} from "antd";
import {CloseOutlined} from "@ant-design/icons";

const OptionEditForm = ({ testId, option, correctOptionId, onCorrectStateChange, onOptionBlur }) => {
  const [optionText, setOptionText] = useState(option.text);
  const handleDeleteOption = (optionId) => {
    console.log("delete", testId, optionId)
  }

  const handleCorrectStateChange = (e) => {
    onCorrectStateChange(Number(e.target.value))
  }

  const handleOptionTextChange = e => setOptionText(e.target.value)

  return (
    <Row key={option.id} justify="space-between">
      <Col span={18}><Input value={optionText} onChange={handleOptionTextChange} onBlur={() => onOptionBlur({ text: optionText, is_correct: option.id === correctOptionId }, option.id)} /></Col>
      <Col span={2}><Radio checked={option.id === correctOptionId} value={option.id} onClick={handleCorrectStateChange} /></Col>
      <Col><CloseOutlined onClick={() => handleDeleteOption(option.id)} /></Col>
    </Row>
  );
};

OptionEditForm.propTypes = {

};

export default OptionEditForm;
