import React from 'react';
import PropTypes from 'prop-types';
import {
  Outlet, useNavigate,
} from "react-router-dom";
import {Button, Layout, Menu, Breadcrumb} from "antd";
import {useAuth} from "../../hooks/useAuth.js";

import "./adminLayout.css";

const { Header, Content, Footer } = Layout;

const AdminLayout = props => {
  const auth = useAuth();
  let navigate = useNavigate();

  const onLogout = () => auth.signout(() => navigate("/login"))

  return (
    <Layout className="admin-layout">
      <Header className="main-header">
        <div>
          <div className="logo" />
          <Menu
            theme="dark"
            mode="horizontal"
            defaultSelectedKeys={['2']}
            items={new Array(3).fill(null).map((_, index) => {
              const key = index + 1;
              return {
                key,
                label: `nav ${key}`,
              };
            })}
          />
        </div>
        <Button type="primary" onClick={onLogout}>
          Logout
        </Button>
      </Header>
      <Content
        style={{
          padding: '0 50px',
        }}
        className="admin-content"
      >
        <Breadcrumb
          style={{
            margin: '16px 0',
          }}
        >
          <Breadcrumb.Item>Home</Breadcrumb.Item>
          <Breadcrumb.Item>List</Breadcrumb.Item>
          <Breadcrumb.Item>App</Breadcrumb.Item>
        </Breadcrumb>
        <Outlet />
      </Content>
      <Footer
        style={{
          textAlign: 'center',
        }}
      >
        Ant Design ©2018 Created by Ant UED
      </Footer>
    </Layout>
  );
};

AdminLayout.propTypes = {

};

export default AdminLayout;
