import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  DateInput,
  SelectInput,
  ReferenceArrayInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const CancellationsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Razón de anulación" source='reason' />
    <TextInput label="Monto" source='amount' />
    <ReferenceArrayInput source="cancellation_type_id" reference="cancellation-types" label="Tipo">
      <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput>
    <DateInput source="gt_date" label='Realizado después de' />
    <DateInput source="lt_date" label='Realizado antes de' />
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
            <TextField source="cancellable.taxpayer.name" label="Razón social"/>
            <TextField source="reason" label="Razón de anulación"/>
            <TextField source="type.name" label="Tipo"/>
            <TextField source="user.login" label="Login"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default CancellationsList;
