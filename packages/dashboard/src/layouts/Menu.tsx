import * as React from 'react';
import { useSelector } from 'react-redux';
import { useMediaQuery, Theme, Box } from '@material-ui/core';
import {
    DashboardMenuItem,
    MenuProps,
} from 'react-admin';
import SubMenu from './SubMenu';
import { AppState } from '@sauco/common/types';
import MenuItemLink from './MenuItemLink'
// Menu icons
import TaxpayersMenuIcon from '@material-ui/icons/AssignmentInd';
import ReportIcon from '@material-ui/icons/Assessment';
import SettingsIcon from '@material-ui/icons/Settings';
import LabelIcon from '@material-ui/icons/Label';
import EmojiSymbolsIcon from '@material-ui/icons/EmojiSymbols';
import LanguageIcon from '@material-ui/icons/Language';
import DashboardIcon from '@material-ui/icons/Dashboard';
// Resources
import users from '../users';
import concepts from '../concepts';
import movements from '../movements';
import liquidations from '../liquidations';
import payments from '../payments';
import cancellations from '../cancellations';
import affidavits from '../affidavits';
import taxpayers from '../taxpayers';
import fines from '../fines';
import applications from '../applications';
import licenses from '../licenses';
import paymentTypes from '../payment-types';
import paymentMethods from '../payment-methods';
import ordinances from '../ordinances';
import economicActivities from '../economic-activities';
import petroPrices from '../petro-prices';
import items from '../items';
import permissions from '../permissions';
import states from '../states';
import municipalities from '../municipalities';
import parishes from '../parishes';
import liquidationTypes from '../liquidation-types';
import signatures from '../signatures';

type MenuName = 'reports' | 'people' | 'settings' | 'administration' | 'cadastre' | 'rates';

const Menu: React.FC<MenuProps> = ({ onMenuClick, logout, dense = false }) => {
    const [state, setState] = React.useState({
        people: true,
        reports: false,
        settings: false,
        administration: false,
        cadastre: false,
        rates: false,
        env: process.env.REACT_APP_ENV
    });
    const isXSmall = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('xs')
    );
    const open = useSelector((state: AppState) => state.admin.ui.sidebarOpen);

    const handleToggle = (menu: MenuName) => {
        setState(state => ({ ...state, [menu]: !state[menu] }));
    };

    return (
        <Box mt={1}>
            {' '}
            <MenuItemLink
                to="/"
                primaryText={open ? 'Inicio' : <></>}
                leftIcon={<DashboardIcon />}
                onClick={onMenuClick}
                sidebarIsOpen={open}
                dense={dense}
                exact
            />
            {(state.env !== 'PRODUCTION') && (
                <>
                    <SubMenu
                        handleToggle={() => handleToggle('people')}
                        isOpen={state.people}
                        sidebarIsOpen={open}
                        name="Contribuyentes"
                        icon={<TaxpayersMenuIcon />}
                        dense={dense}
                    >
                        <MenuItemLink
                            to={'/'+taxpayers.name}
                            primaryText={taxpayers.options.label}
                            leftIcon={<taxpayers.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </SubMenu>
                </>
            )}
            <SubMenu
                handleToggle={() => handleToggle('rates')}
                isOpen={state.rates}
                sidebarIsOpen={open}
                name="Tasas"
                icon={<EmojiSymbolsIcon />}
                dense={dense}
            >
                {(state.env !== 'PRODUCTION') && (
                    <>
                        <MenuItemLink
                            to={'/'+concepts.name}
                            primaryText={concepts.options.label}
                            leftIcon={<concepts.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </>
                )}
                <MenuItemLink
                    to={'/'+petroPrices.name}
                    primaryText={petroPrices.options.label}
                    leftIcon={<petroPrices.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={'/'+economicActivities.name}
                    primaryText={economicActivities.options.label}
                    leftIcon={<economicActivities.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            {(state.env !== 'PRODUCTION') && (
                <>
                    <SubMenu
                        handleToggle={() => handleToggle('cadastre')}
                        isOpen={state.cadastre}
                        sidebarIsOpen={open}
                        name="Catastro"
                        icon={<LanguageIcon />}
                        dense={dense}
                    >
                        <MenuItemLink
                            to={'/'+states.name}
                            primaryText={states.options.label}
                            leftIcon={<states.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+municipalities.name}
                            primaryText={municipalities.options.label}
                            leftIcon={<municipalities.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+parishes.name}
                            primaryText={parishes.options.label}
                            leftIcon={<parishes.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </SubMenu>
                </>
            )}
            <SubMenu
                handleToggle={() => handleToggle('reports')}
                isOpen={state.reports}
                sidebarIsOpen={open}
                name="Reportes"
                icon={<ReportIcon />}
                dense={dense}
            >
                <MenuItemLink
                    to={'/'+payments.name}
                    primaryText={payments.options.label}
                    leftIcon={<payments.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={'/'+cancellations.name}
                    primaryText={cancellations.options.label}
                    leftIcon={<cancellations.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={'/'+liquidations.name}
                    primaryText={liquidations.options.label}
                    leftIcon={<liquidations.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={'/'+licenses.name}
                    primaryText={licenses.options.label}
                    leftIcon={<licenses.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={'/'+movements.name}
                    primaryText={movements.options.label}
                    leftIcon={<movements.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                {(state.env !== 'PRODUCTION') && (
                    <>
                        <MenuItemLink
                            to={'/'+fines.name}
                            primaryText={fines.options.label}
                            leftIcon={<fines.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+applications.name}
                            primaryText={applications.options.label}
                            leftIcon={<applications.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+affidavits.name}
                            primaryText={affidavits.options.label}
                            leftIcon={<affidavits.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </>
                )}
            </SubMenu>
            {(state.env !== 'PRODUCTION') && (
                <>
                    <SubMenu
                        handleToggle={() => handleToggle('settings')}
                        isOpen={state.settings}
                        sidebarIsOpen={open}
                        name="Configuraciones"
                        icon={<SettingsIcon />}
                        dense={dense}
                    >
                        <MenuItemLink
                            to={'/'+paymentTypes.name}
                            primaryText={paymentTypes.options.label}
                            leftIcon={<paymentTypes.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+paymentMethods.name}
                            primaryText={paymentMethods.options.label}
                            leftIcon={<paymentMethods.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+ordinances.name}
                            primaryText={ordinances.options.label}
                            leftIcon={<ordinances.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+items.name}
                            primaryText={items.options.label}
                            leftIcon={<items.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+liquidationTypes.name}
                            primaryText={liquidationTypes.options.label}
                            leftIcon={<liquidationTypes.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </SubMenu>
                    <SubMenu
                        handleToggle={() => handleToggle('administration')}
                        isOpen={state.administration}
                        sidebarIsOpen={open}
                        name="Personal"
                        icon={<LabelIcon />}
                        dense={dense}
                    >
                        <MenuItemLink
                            to={'/'+signatures.name}
                            primaryText={signatures.options.label}
                            leftIcon={<signatures.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+permissions.name}
                            primaryText={permissions.options.label}
                            leftIcon={<permissions.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                        <MenuItemLink
                            to={'/'+users.name}
                            primaryText={users.options.label}
                            leftIcon={<users.icon />}
                            onClick={onMenuClick}
                            sidebarIsOpen={open}
                            dense={dense}
                        />
                    </SubMenu>
                </>
            )}
            {isXSmall && logout}
        </Box>
    );
};

export default Menu;
