import * as React from "react";
import {
  Filter,
  TextInput,
  DateField,
  List, 
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
  ReferenceInput,
  SelectInput,
  ReferenceArrayInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const CancellationsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
    <TextInput label="Monto" source='amount' />
    <ReferenceArrayInput source="cancellation_type_id" reference="cancellation-types" label="Tipo">
      <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput> 
  </Filter>
);

const CancellationsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Anulaciones"
      bulkActionButtons={false}
      filters={<CancellationsFilter />}
      exporter={false}
    >
      { 
        isSmall 
        ? (      
          <SimpleList
            primaryText={record => `${record.reason}`}
            secondaryText={record => `${record.type.name}`}
            tertiaryText={record => `${record.user.login}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="reason" label="Razón"/>
            <TextField source="type.name" label="Tipo"/>
            <TextField source="user.login" label="Login"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default CancellationsList;
