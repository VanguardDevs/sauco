import * as React from 'react';
import MoneyIcon from '@material-ui/icons/Money';
import CardWithIcon from './CardWithIcon';

interface Props {
    value?: any;
    created_at?: string;
}

const PetroPrice: React.FC<Props> = ({ value, created_at }) => {
    return (
        <CardWithIcon
            to="/petro-prices"
            icon={MoneyIcon}
            title='Tasa del día'
            subtitle={value}
            extra={`Última actualización ${created_at}`}
        />
    );
};

export default PetroPrice;
