import * as React from 'react'
import { Grid, InputLabel } from '@material-ui/core'
import PropTypes from 'prop-types';

const InputContainer = ({ children, labelName, md, xs, sm, ...rest }) => (
    <Grid item xs={xs} sm={sm} md={md}>
        <InputLabel>{labelName}</InputLabel>
        {React.cloneElement(children, rest)}
    </Grid>
)

InputContainer.propTypes = {
    children: PropTypes.node,
    md: PropTypes.number,
    lg: PropTypes.number
};

InputContainer.defaultProps = {
    label: "",
    labelName: 'Input',
    children: <React.Fragment />,
    md: 6,
    lg: 3,
    xs: 12,
    sm: 12
}

export default InputContainer
