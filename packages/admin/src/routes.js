import ItemsList from './pages/items/ItemList'
import ItemEdit from './pages/items/ItemEdit'
import ItemCreate from './pages/items/ItemCreate'
import ItemShow from './pages/items/ItemShow'
import UserList from './pages/users/UserList'
import UserCreate from './pages/users/UserCreate'
import UserEdit from './pages/users/UserEdit'
import CubicleList from './pages/cubicles/CubicleList'
// import CubicleCreate from './pages/cubicles/CubicleCreate'
import Dashboard from './pages/dashboard'
import TaxpayerList from './pages/taxpayers/TaxpayerList'
import TaxpayerCreate from './pages/taxpayers/TaxpayerCreate'
import TaxpayerEdit from './pages/taxpayers/TaxpayerEdit'
import TaxpayerShow from './pages/taxpayers/TaxpayerShow'
import RoleList from './pages/roles/RoleList'
import RoleCreate from './pages/roles/RoleCreate'
import RoleEdit from './pages/roles/RoleEdit'
import Security from './pages/account/Security';
import CubicleEdit from './pages/cubicles/CubicleEdit';

const routes = [
    {
        path: '/',
        component: <Dashboard />,
        roles: 'admin,liquidator'
    },
    {
        path: '/taxpayers',
        component: <TaxpayerList />,
        roles: 'admin'
    },
    {
        path: '/taxpayers/:id',
        component: <TaxpayerShow />,
        roles: 'admin'
    },
    {
        path: '/taxpayers/:id/edit',
        component: <TaxpayerEdit />,
        roles: 'admin'
    },
    {
        path: '/taxpayers/create',
        component: <TaxpayerCreate />,
        roles: 'admin'
    },
    {
        path: '/cubicles/:id/edit',
        component: <CubicleEdit />,
        roles: 'admin'
    },
    {
        path: '/cubicles',
        component: <CubicleList />,
        roles: 'admin'
    },
    {
        path: '/items',
        component: <ItemsList />,
        roles: 'admin'
    },
    {
        path: '/items/:id',
        component: <ItemShow />,
        roles: 'admin'
    },
    {
        path: '/items/:id/edit',
        component: <ItemEdit />,
        roles: 'admin'
    },
    {
        path: '/items/create',
        component: <ItemCreate />,
        roles: 'admin'
    },
    {
        path: '/roles',
        component: <RoleList />,
        roles: 'admin'
    },
    {
        path: '/roles/:id/edit',
        component: <RoleEdit />,
        roles: 'admin'
    },
    {
        path: '/roles/create',
        component: <RoleCreate />,
        roles: 'admin'
    },
    {
        path: '/users',
        component: <UserList />,
        roles: 'admin'
    },
    {
        path: '/users/:id',
        component: <UserEdit />,
        roles: 'admin'
    },
    {
        path: '/users/create',
        component: <UserCreate />,
        roles: 'admin'
    },
    {
        path: '/security',
        component: <Security />,
        roles: 'admin'
    },
    // {
    //     path: '/cubicles/:id/create',
    //     component: <CubicleCreate />,
    //     roles: 'admin'
    // },
];

export default routes
