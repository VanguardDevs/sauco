import * as React from 'react';
import ShoppingCartIcon from '@material-ui/icons/ShoppingCart';
import CardWithIcon from './CardWithIcon';

const PendingLiquidations = ({ value }) => (
    <CardWithIcon
        to="/liquidations"
        icon={ShoppingCartIcon}
        title={'Liquidaciones pendientes'}
        subtitle={value}
    />
);

export default PendingLiquidations;
