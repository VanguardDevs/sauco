import * as React from "react";
// import { useDispatch } from 'react-redux';
// import { setDialog } from '../actions';
import {
  Filter,
  TextInput,
  DateField,
  List, 
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const ConceptFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
    <TextInput label="Monto" source='amount' />
  </Filter>
);

const ConceptList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Conceptos"
      bulkActionButtons={false}
      filters={<ConceptFilter />}
      exporter={false}
    >
      { 
        isSmall 
        ? (      
          <SimpleList
            primaryText={record => `${record.name}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="name" label="Nombre"/>
            <TextField source="liquidation_type.name" label="Tipo"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default ConceptList;
