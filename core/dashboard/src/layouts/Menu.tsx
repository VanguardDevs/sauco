import * as React from 'react';
import { FC, useState } from 'react';
import { useSelector } from 'react-redux';
import SettingsIcon from '@material-ui/icons/Settings';
import LabelIcon from '@material-ui/icons/Label';
import { useMediaQuery, Theme, Box } from '@material-ui/core';
import {
    useTranslate,
    DashboardMenuItem,
    MenuItemLink,
    MenuProps,
} from 'react-admin';

import concepts from '../concepts';
import movements from '../movements';
import liquidations from '../liquidations';
import payments from '../payments';
import cancellations from '../cancellations';
import affidavits from '../affidavits';
import taxpayers from '../taxpayers';
import fines from '../fines';
import applications from '../applications';
import SubMenu from './SubMenu';
import { AppState } from '../types';

// Menu icons
import TaxpayersMenuIcon from '@material-ui/icons/AssignmentInd';
import ReportIcon from '@material-ui/icons/Assessment';
type MenuName = 'reports' | 'taxpayers';

const Menu: FC<MenuProps> = ({ onMenuClick, logout, dense = false }) => {
    const [state, setState] = useState({
        reports: true,
        taxpayers: true,
    });
    const translate = useTranslate();
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
            <DashboardMenuItem onClick={onMenuClick} sidebarIsOpen={open} />
            <SubMenu
                handleToggle={() => handleToggle('taxpayers')}
                isOpen={state.taxpayers}
                sidebarIsOpen={open}
                name="pos.menu.taxpayers"
                icon={<TaxpayersMenuIcon />}
                dense={dense}
            >
                <MenuItemLink
                    to={taxpayers.name}
                    primaryText={taxpayers.options.label}
                    leftIcon={<taxpayers.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('reports')}
                isOpen={state.reports}
                sidebarIsOpen={open}
                name="pos.menu.reports"
                icon={<ReportIcon />}
                dense={dense}
            >
                <MenuItemLink
                    to={applications.name}
                    primaryText={applications.options.label}
                    leftIcon={<applications.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={payments.name}
                    primaryText={payments.options.label}
                    leftIcon={<payments.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={cancellations.name}
                    primaryText={cancellations.options.label}
                    leftIcon={<cancellations.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={liquidations.name}
                    primaryText={liquidations.options.label}
                    leftIcon={<liquidations.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={movements.name}
                    primaryText={movements.options.label}
                    leftIcon={<movements.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={affidavits.name}
                    primaryText={affidavits.options.label}
                    leftIcon={<affidavits.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={fines.name}
                    primaryText={fines.options.label}
                    leftIcon={<fines.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={concepts.name}
                    primaryText={concepts.options.label}
                    leftIcon={<concepts.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            {isXSmall && logout}
        </Box>
    );
};

export default Menu;