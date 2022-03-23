import * as React from 'react';
import { styled } from '@material-ui/core';

const Dot = styled('span')({
    height: '5px',
    width: '5px',
    backgroundColor: '#bbb',
    borderRadius: '50%',
    display: 'inline-block',
    margin: '0.5rem'
});

export default () => <Dot />
