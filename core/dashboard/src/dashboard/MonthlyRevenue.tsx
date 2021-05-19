import * as React from 'react';
import DollarIcon from '@material-ui/icons/AttachMoney';
import { useTranslate } from 'react-admin';

import CardWithIcon from './CardWithIcon';

interface Props {
    value?: string;
}

const MonthlyRevenue: React.FC<Props> = ({ value }) => {
    return (
        <CardWithIcon
            to="/payments"
            icon={DollarIcon}
            title={'Total de ingresos mensual'}
            subtitle={value}
        />
    );
};

export default MonthlyRevenue;
