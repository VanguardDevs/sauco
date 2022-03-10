import * as React from 'react';
import WallpaperIcon from '@material-ui/icons/Wallpaper';
import CardWithIcon from './CardWithIcon';

interface Props {
    value?: any;
}

const EmmitedLicenses: React.FC<Props> = ({ value }) => {
    return (
        <CardWithIcon
            to="/licenses"
            icon={WallpaperIcon}
            title={'Licencias emitidas'}
            subtitle={value}
        />
    );
};

export default EmmitedLicenses;
