import * as React from 'react'
import Grid from '@mui/material/Grid'
import InputLabel from '@mui/material/InputLabel'
import PropTypes from 'prop-types';

const InputContainer = ({ children, label, md, xs, sm, ...rest }) => (
    <Grid item xs={xs} sm={sm} md={md}>
        <InputLabel sx={{
            color: theme => theme.palette.text.primary
        }}>{label}</InputLabel>
        {React.cloneElement(children, rest)}
    </Grid>
)

InputContainer.propTypes = {
    children: PropTypes.node,
    md: PropTypes.number,
    lg: PropTypes.number
};

InputContainer.defaultProps = {
    label: 'Input',
    children: <React.Fragment />,
    md: 6,
    lg: 3,
    xs: 12,
    sm: 12
}

export default InputContainer
