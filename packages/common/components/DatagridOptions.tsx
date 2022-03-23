import * as React from 'react'
import { DeleteButton } from 'react-admin';
import Box from '@material-ui/core/Box';
import EditButton from './EditButton'

const DatagridOptions: React.FC<DatagridOptionsProps> = ({ children, ...rest }) => (
    <Box component='div' display='flex' justifyContent='end'>
        <EditButton size="small" {...rest} />
        <DeleteButton {...rest} />
        {React.cloneElement(children, rest)}
    </Box>
)

interface DatagridOptionsProps {
    children?: React.ReactElement;
};

DatagridOptions.defaultProps = {
    children: <React.Fragment />
}

export default DatagridOptions
