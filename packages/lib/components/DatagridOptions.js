import * as React from 'react'
import DeleteButton from '@sauco/lib/components/DeleteButton'
import Box from '@material-ui/core/Box';
import PropTypes from 'prop-types';
import EditButton from './EditButton'

const DatagridOptions = ({ children, confirmTitle, confirmContent, deleteButtonLabel, ...rest }) => (
    <Box component='div' display='flex' justifyContent='end'>
        <EditButton size="small" {...rest} />
        <DeleteButton
            confirmColor='warning'
            confirmTitle={confirmTitle}
            confirmContent={confirmContent}
            label={deleteButtonLabel}
            {...rest}
        />
        {React.cloneElement(children, rest)}
    </Box>
)

DatagridOptions.propTypes = {
    children: PropTypes.node
};

DatagridOptions.defaultProps = {
    children: <React.Fragment />
}

export default DatagridOptions
