import { Layout, LayoutProps, Sidebar } from 'react-admin';
import AppBar from './AppBar';
import Menu from './Menu';
import theme from './themes';

const CustomSidebar = (props: any) => <Sidebar {...props} size={200} />;

export default (props: LayoutProps) => (
    <Layout
        {...props}
        appBar={AppBar}
        sidebar={CustomSidebar}
        menu={Menu}
        theme={theme}
    />
);
