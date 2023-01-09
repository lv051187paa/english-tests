import React, {useEffect} from 'react';
import PropTypes from 'prop-types';
import {Button, Col, Form, Input, Row} from "antd";

import {useLocation, useNavigate} from "react-router-dom";
import { useAuth } from "../../hooks/useAuth.js";

const LoginForm = props => {
  const auth = useAuth();
  let navigate = useNavigate();
  let location = useLocation();
  let from = location.state?.from?.pathname || "/admin";

  useEffect(() => {
    if(auth.isAuthorized) {
      navigate(from, { replace: true })
    }
  }, [auth.isAuthorized])

  const onFinish = async (values) => {
    auth.signin(values, () => navigate(from, { replace: true }))
  };

  const onFinishFailed = (errorInfo) => {
    console.log('Failed:', errorInfo);
  };

  return (
    <Row justify="center">
      <Col span={12}>
        <Form
          name="basic"
          labelCol={{
            span: 8,
          }}
          wrapperCol={{
            span: 16,
          }}
          initialValues={{
            remember: true,
          }}
          onFinish={onFinish}
          onFinishFailed={onFinishFailed}
          autoComplete="off"
        >
          <Form.Item
            label="Username"
            name="email"
            rules={[
              {
                required: true,
                message: 'Please input your username!',
              },
            ]}
          >
            <Input/>
          </Form.Item>

          <Form.Item
            label="Password"
            name="password"
            rules={[
              {
                required: true,
                message: 'Please input your password!',
              },
            ]}
          >
            <Input.Password/>
          </Form.Item>

          {/*<Form.Item*/}
          {/*  name="remember"*/}
          {/*  valuePropName="checked"*/}
          {/*  wrapperCol={{*/}
          {/*    offset: 8,*/}
          {/*    span: 16,*/}
          {/*  }}*/}
          {/*>*/}
          {/*  <Checkbox>Remember me</Checkbox>*/}
          {/*</Form.Item>*/}

          <Form.Item
            wrapperCol={{
              offset: 8,
              span: 16,
            }}
          >
            <Button type="primary" htmlType="submit">
              Login
            </Button>
          </Form.Item>
        </Form>
      </Col>
    </Row>
  );
};

LoginForm.propTypes = {};

export default LoginForm;
