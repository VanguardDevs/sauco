import * as React from "react";
import {
    TextInput,
    List,
    Datagrid,
    TextField,
    SimpleList,
    TopToolbar,
    CreateButton,
    BooleanInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const usersFilters = [
    <TextInput label="login" source='Login' />,
    <BooleanInput label='Activo' source='status' />
];

const ListActions: React.FC = props => (
    <TopToolbar>
        <CreateButton basePath="/users" />
    </TopToolbar>
);

const UsersList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List
            title="Usuarios"
            filters={usersFilters}
            actions={<ListActions />}
            {...props}
        >
            {
                isSmall
                ? (
                    <SimpleList
                        primaryText={record => `${record.login}`}
                        secondaryText={record => `${record.full_name}`}
                        linkType={"show"}
                    />
                )
                : (
                    <Datagrid>
                        <TextField source="login" label="Login"/>
                        <TextField source="full_name" label="Nombre"/>
                    </Datagrid>
                )
            }
        </List>
    );
};

export default UsersList;
