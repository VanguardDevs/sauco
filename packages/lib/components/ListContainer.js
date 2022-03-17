import * as React from 'react';
import { Typography, Box } from '@material-ui/core';
import Pagination from '@../components/Pagination';
import PropTypes from 'prop-types'

const ListContainer = ({ title, actions, list, nopagination }) => (
    <>
        {(title) && (
            <Typography variant='h5'>
                Trivias
            </Typography>
        )}
        {(actions) && (
            <React.Fragment>
                {React.cloneElement(actions)}
            </React.Fragment>
        )}
        <Box
            display="flex"
            height='100%'
            width='inherit'
            flexDirection="column"
            justifyContent="space-between"
        >
            {React.cloneElement(list)}
            {(!nopagination) && <Pagination />}
        </Box>
    </>
);

ListContainer.propTypes = {
    title: PropTypes.string,
    actions: PropTypes.node,
    list: PropTypes.node.isRequired,
    nopagination: PropTypes.bool
};

ListContainer.defaultProps = {
    nopagination: false
}

export default ListContainer;
