import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";

import Login from "./pages/Login";
import AuthProvider from "./contexts/AuthProvider.jsx";
import RequireAuth from "./components/RequireAuth/RequireAuth.jsx";

import AdminLayout from "./components/AdminLayout";
import Dashboard from "./pages/admin/Dashboard";

import './App.css'

const router = createBrowserRouter([
  {
    path: "/admin",
    element: <RequireAuth>
        <AdminLayout />
      </RequireAuth>,
    children: [
      {
        element: <Dashboard />,
        index: true
      },
      {
        path: '*',
        element: <div>No match</div>,
      }
    ]
  },
  {
    path: '/login',
    element: <Login/>,
  },
  {
    path: '*',
    element: <div>No match</div>,
  }
]);

const App = () => (
  <AuthProvider>
    <RouterProvider router={router}/>
  </AuthProvider>
)

export default App
