import { Form, } from 'antd';
import {EditableTableContext} from "../../contexts/editableTableContext";

const EditableRow = props => {
  const [form] = Form.useForm();
  return (
    <Form form={form} component={false}>
      <EditableTableContext.Provider value={form}>
        <tr {...props} />
      </EditableTableContext.Provider>
    </Form>
  );
};

EditableRow.propTypes = {

};

export default EditableRow;
