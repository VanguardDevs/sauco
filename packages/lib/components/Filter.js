import * as React from "react";
import {
  Filter,
  TextInput
} from 'react-admin';

const CustomFilter = (props) => {
  const {
    defaultfilter,
    children
  } = props;

  return (
    <Filter {...props}>
      <TextInput label="Buscar" source={defaultfilter} alwaysOn />
      {children}
    </Filter>
  );
}

export default CustomFilter;
