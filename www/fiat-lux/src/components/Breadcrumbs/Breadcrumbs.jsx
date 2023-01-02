import React from "react";
import PropTypes from "prop-types";
import { Breadcrumb } from "antd";

import { useBreadcrumbs } from "../../hooks/useBreadcrumbs.js";

const Breadcrumbs = props => {
  const crumbs = useBreadcrumbs();

  return (
    <Breadcrumb
      style={{
        margin: "16px 0",
      }}
    >
      {crumbs.map((crumb, index) => <Breadcrumb.Item key={index}>{crumb}</Breadcrumb.Item>)}
    </Breadcrumb>
  );
};

Breadcrumbs.propTypes = {};

export default Breadcrumbs;
