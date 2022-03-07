import * as React from 'react';
import MoneyIcon from '@material-ui/icons/Money';
import CardWithIcon from './CardWithIcon';

interface Props {
    value?: any;
}

const PetroPrice: React.FC<Props> = ({ value }) => {
    return (
        <CardWithIcon
            to="/petro-prices"
            icon={MoneyIcon}
            title='Tasa del día'
            subtitle={value}
            extra='Ultima actualización'
        />
    );
};

export default PetroPrice;
