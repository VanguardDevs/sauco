import * as React from 'react'
import { linkToRecord, useResourceContext } from 'ra-core';
import { Link } from 'react-router-dom';
import IconButton from '@material-ui/core/IconButton';
import styled from '@material-ui/styles/styled';
import EditIcon from '@material-ui/icons/Edit';

const CustomizedIconButton = styled(IconButton)(({ theme }) => ({
    color: `${theme.palette.primary.main} !important`,
    margin: '0 0.5rem'
}));

const EditButton = ({
    basePath,
    record,
    scrollToTop = true,
    ...rest
}) => {
    const resource = useResourceContext();

    return (
        <CustomizedIconButton
            component={Link}
            to={React.useMemo(
                () => ({
                    pathname: record
                        ? linkToRecord(basePath || `/${resource}`, record.id)
                        : '',
                    state: { _scrollToTop: scrollToTop },
                }),
                [basePath, record, resource, scrollToTop]
            )}
            label='Editar'
            onClick={stopPropagation}
            {...rest}
        >
            <EditIcon />
        </CustomizedIconButton>
    );
};

const stopPropagation = e => e.stopPropagation();

export default EditButton
