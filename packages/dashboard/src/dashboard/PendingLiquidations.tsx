import * as React from 'react';
import ShoppingCartIcon from '@material-ui/icons/ShoppingCart';
import CardWithIcon from './CardWithIcon';

interface Props {
    value?: any;
}

const PendingLiquidations: React.FC<Props> = ({ value }) => {
    return (
        <CardWithIcon
            to="/liquidations"
            icon={ShoppingCartIcon}
            title={'Liquidaciones pendientes'}
            subtitle={value}
        />
    );
};

export default PendingLiquidations;
