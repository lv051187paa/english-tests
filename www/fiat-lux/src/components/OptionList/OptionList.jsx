import PropTypes from 'prop-types';
import {Tag} from "antd";
import {PlusCircleOutlined} from "@ant-design/icons";

import "./optionList.css";

const OptionList = ({ id, options, onOptionModalOpen }) => {
  const handleOptionModalOpen = () => onOptionModalOpen(id);

  return (
    <div>
      {options.map(({ id, text, is_correct }) => {
        const color = is_correct ? 'green' : 'volcano';

        return (
          <Tag color={color} key={id}>
            {text}
          </Tag>
        )
      })}
      <div className={options.length ? "add-option" : ""}>
        <PlusCircleOutlined onClick={handleOptionModalOpen} />
      </div>
    </div>
  )
}

OptionList.propTypes = {

};

export default OptionList;
