import * as React from "react";
import {
    Filter,
    TextInput,
    DateInput,
    List,
    Datagrid,
    TextField,
    SimpleList,
    ReferenceArrayInput,
    ShowButton,
    SelectInput
} from 'react-admin';
import { Actions, RecordActions } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';
import DownloadButton from '../components/DownloadButton'

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

const ListActions: React.FC = props => (
    <Actions {...props}>
        <DownloadButton
            downloableName='anulaciones'
        />
    </Actions>
);

const CancellationsList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Anulaciones"
            filters={<CancellationsFilter />}
            actions={<ListActions />}
            bulkActionButtons={false}
        >
        {
            isSmall
            ? (
                <SimpleList
                    primaryText={record => `${record.num}`}
                    secondaryText={record => `${record.processed_at}`}
                    tertiaryText={record => `${record.pretty_amount}`}
                    linkType={"show"}
                />
            )
            : (
                <Datagrid>
                    <TextField source="cancellable.taxpayer.name" label="Razón social"/>
                    <TextField source="reason" label="Razón de anulación"/>
                    <TextField source="type.name" label="Tipo"/>
                    <TextField source="user.login" label="Login"/>
                    <RecordActions>
                        <ShowButton />
                    </RecordActions>
                </Datagrid>
            )
        }
        </List>
    );
};

export default CancellationsList;
