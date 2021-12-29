import * as React from "react";
import {
  ReferenceArrayInput,
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  SelectInput,
  EditButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const optionRenderer = (choice:any) => `${choice.name}`;

const ConceptFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
    <TextInput label="Monto" source='amount' />
    <ReferenceArrayInput
        source="charging_method_id"
        reference="charging-methods"
        label="Método de cobro"
    >
        <SelectInput
            source="name"
            label="Método de cobro"
            optionText={optionRenderer}
            allowEmpty={false}
        />
    </ReferenceArrayInput>
    <ReferenceArrayInput source="liquidation_type_id" reference="liquidation-types" label="Tipo">
        <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput>
  </Filter>
);

const ConceptList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));  

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
                        <TextField source="amount" label="Monto"/>
                        <TextField source="liquidation_type.name" label="Tipo"/>
                        <EditButton />
                    </Datagrid>
                )
            }
        </List>
    );
};

export default ConceptList;
