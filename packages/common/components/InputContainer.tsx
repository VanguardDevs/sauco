import * as React from 'react'
import Grid from '@material-ui/core/Grid'
import InputLabel from '@material-ui/core/InputLabel'

const InputContainer: React.FC<InputContainerProps> = ({
    children,
    labelName,
    md,
    xs,
    sm,
    ...rest
}) => (
    <Grid item xs={xs} sm={sm} md={md}>
        <InputLabel>{labelName}</InputLabel>
        {React.cloneElement(children, rest)}
    </Grid>
)

interface InputContainerProps {
    children: React.ReactNode;
    md?: number;
    xs?: number;
    lg?: number;
    sm?: number;
    labelName: string;
};

InputContainer.defaultProps = {
    labelName: 'Input',
    children: <React.Fragment />,
    md: 6,
    lg: 3,
    xs: 12,
    sm: 12
}

export default InputContainer
