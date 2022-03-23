import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  EditButton,
  DeleteButton,
  TextField,
  SimpleList
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const OrdinancesFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Nombre" source='description' />
    </Filter>
);

const OrdinancesList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Ordenanzas"
            bulkActionButtons={false}
            filters={<OrdinancesFilter />}
            exporter={false}
        >
        {
            isSmall
            ? (
            <SimpleList
                primaryText={record => `${record.description}`}
            />
            )
            : (
            <Datagrid>
                <TextField source="description" label="Nombre"/>
                <EditButton />
                <DeleteButton />
            </Datagrid>
            )
        }
        </List>
    );
};

export default OrdinancesList;
