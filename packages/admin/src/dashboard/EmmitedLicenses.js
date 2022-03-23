import * as React from 'react';
import WallpaperIcon from '@material-ui/icons/Wallpaper';
import CardWithIcon from './CardWithIcon';

const EmmitedLicenses = ({ value }) => (
    <CardWithIcon
        to="/licenses"
        icon={WallpaperIcon}
        title={'Licencias emitidas'}
        subtitle={value}
    />
);

export default EmmitedLicenses;
