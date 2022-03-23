import * as React from 'react';
import TaxpayerIcon from '@material-ui/icons/SupervisedUserCircle';
import CardWithIcon from './CardWithIcon';

const EmmitedLicenses = ({ value }) => {
    return (
        <CardWithIcon
            to="/taxpayers"
            icon={TaxpayerIcon}
            title={'Contribuyentes registrados'}
            subtitle={value}
        />
    );
};

export default EmmitedLicenses;
