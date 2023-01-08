import React from "react";
import PropTypes from "prop-types";
import {
  Outlet,
  useNavigate,
  useLocation, Link,
} from "react-router-dom";
import { Button, Layout, Menu } from "antd";
import { useAuth } from "../../hooks/useAuth.js";

import "./adminLayout.css";
import Breadcrumbs from "../Breadcrumbs/index.js";

const { Header, Content, Footer } = Layout;

const routes = [
  {
    key: '/admin',
    label: 'Dashboard',
  },
  {
    key: '/admin/questions',
    label: 'Questions'
  }
];

const AdminLayout = props => {
  const auth = useAuth();
  const navigate = useNavigate();
  const location = useLocation();
  const currentRoute = routes.find(({ key }) => key === location.pathname);

  const onLogout = () => auth.signout(() => navigate("/login"));

  return (
    <Layout className="admin-layout">
      <Header className="main-header">
        <Menu
          theme="dark"
          mode="horizontal"
          defaultSelectedKeys={[currentRoute?.key]}
          items={routes.map(({ key, label }) => {
            return {
              key,
              label: <Link to={key}>{label}</Link>,
            };
          })}
        />
        <Button type="primary" onClick={onLogout}>
          Logout
        </Button>
      </Header>
      <Content
        style={{
          padding: "0 50px",
        }}
        className="admin-content"
      >
        <Breadcrumbs />
        <Outlet />
      </Content>
      <Footer
        style={{
          textAlign: "center",
        }}
      >
        Ant Design ©2018 Created by Ant UED
      </Footer>
    </Layout>
  );
};

AdminLayout.propTypes = {};

export default AdminLayout;
