import * as React from 'react';
import DollarIcon from '@material-ui/icons/AttachMoney';

import CardWithIcon from './CardWithIcon';

interface Props {
    value?: string;
}

const MonthlyRevenue: React.FC<Props> = ({ value }) => {
    return (
        <CardWithIcon
            to="/payments"
            icon={DollarIcon}
            title={'Ingresos en los últimos 30 días'}
            subtitle={value}
        />
    );
};

export default MonthlyRevenue;
