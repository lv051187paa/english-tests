import {
  createBrowserRouter, Link,
  RouterProvider,
} from "react-router-dom";

import Login from "./pages/Login";
import AuthProvider from "./contexts/AuthProvider.jsx";
import RequireAuth from "./components/RequireAuth/RequireAuth.jsx";

import AdminLayout from "./components/AdminLayout";
import Dashboard from "./pages/admin/Dashboard/index.js";
import Questions from "./pages/admin/Questions";

import "./App.css";

const router = createBrowserRouter([
  {
    path: "/admin",
    element: (
      <RequireAuth>
        <AdminLayout />
      </RequireAuth>
    ),
    handle: {
      crumb: () => <Link to="/admin">Admin</Link>
    },
    children: [
      {
        element: <Dashboard />,
        index: true,
        handle: {
          crumb: () => <span>Dashboard</span>
        }
      },
      {
        element: <Questions />,
        path: "/admin/questions/:groupId",
        handle: {
          crumb: () => <span>Questions</span>
        }
      },
      {
        element: <Questions />,
        path: "/admin/questions",
        handle: {
          crumb: () => <span>Questions</span>
        }
      },
      {
        path: "*",
        element: <div>No match</div>,
      }
    ]
  },
  {
    path: "/login",
    element: <Login />,
  },
  {
    path: "*",
    element: <div>No match</div>,
  }
]);

const App = () => (
  <AuthProvider>
    <RouterProvider router={router} />
  </AuthProvider>
);

export default App;
