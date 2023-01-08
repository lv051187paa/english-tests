import { useContext, useEffect, useRef, useState } from "react";
import PropTypes from "prop-types";
import { Form, Input } from "antd";
import { EditableTableContext } from "../../../contexts/editableTableContext.js";
import { updateQuestion } from "../../../api/questions.js";

import "./editableTextCell.css";

const EditableTextCell = ({
  title,
  editable,
  children,
  dataIndex,
  record,
  onTestUpdated,
  ...restProps
}) => {
  const [isEditing, setIsEditing] = useState(false);
  const inputRef = useRef(null);
  const form = useContext(EditableTableContext);

  const handleSave = (data) => {
    updateQuestion(record.id, data)
      .then(({ data }) => {
        onTestUpdated(data.test);
      });
  };

  useEffect(() => {
    if (isEditing) {
      inputRef.current.focus();
    }
  }, [isEditing]);
  const toggleEdit = () => {
    setIsEditing(!isEditing);
    form.setFieldsValue({
      [dataIndex]: record[dataIndex],
    });
  };
  const save = async () => {
    try {
      const values = await form.validateFields();
      toggleEdit();
      handleSave(values);
    } catch (errInfo) {
      console.log("Save failed:", errInfo);
    }
  };
  let childNode = children;
  if (editable) {
    childNode = isEditing ? (
      <Form.Item
        style={{
          margin: 0,
        }}
        name={dataIndex}
        rules={[
          {
            required: true,
            message: `${title} is required.`,
          },
        ]}
      >
        <Input ref={inputRef} onPressEnter={save} onBlur={save} />
      </Form.Item>
    ) : (
      <div
        className="editable-cell-value-wrap"
        style={{
          paddingRight: 24,
        }}
        onClick={toggleEdit}
      >
        {children}
      </div>
    );
  }
  return <td {...restProps}>{childNode}</td>;
};

EditableTextCell.propTypes = {};

export default EditableTextCell;
