import * as React from 'react';
import TaxpayerIcon from '@material-ui/icons/SupervisedUserCircle';
import CardWithIcon from './CardWithIcon';

interface Props {
    value?: any;
}

const EmmitedLicenses: React.FC<Props> = ({ value }) => {
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
