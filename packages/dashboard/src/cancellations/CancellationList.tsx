import * as React from "react";
import {
    FilterContext,
    TextInput,
    ListBase,
    Datagrid,
    TextField,
    SimpleList,
    DateInput,
    SelectInput,
    ShowButton,
    ReferenceArrayInput,
    TopToolbar,
    FilterForm,
    FilterButton,
    Button,
    sanitizeListRestProps
} from 'react-admin';
import { Theme, useMediaQuery,Box } from '@material-ui/core';
import { RecordActions } from '@sauco/common/components';
import IconEvent from '@material-ui/icons/Event';

const Toolbar: React.FC = props => {
    return (
        <Box component="div" display="flex" justifyContent="space-between">
            <FilterContext.Provider value={cancellationsFilter}>
                <FilterForm />
                <TopToolbar {...sanitizeListRestProps(props)}>
                    <FilterButton />
                    <Button
                        onClick={() => { alert('Your custom action'); }}
                        label="Show calendar"
                    >
                        <IconEvent/>
                    </Button>
                </TopToolbar>
            </FilterContext.Provider>
        </Box>
    )
};

export const cancellationsFilter = [
    <TextInput label="Razón de anulación" source='reason' />,
    <TextInput label="Monto" source='amount' />,
    <ReferenceArrayInput source="cancellation_type_id" reference="cancellation-types" label="Tipo">
        <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput>,
    <DateInput source="gt_date" label='Realizado después de' />,
    <DateInput source="lt_date" label='Realizado antes de' />,
];

const CancellationsList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <ListBase
            perPage={20}
            sort={{ field: 'reference', order: 'ASC' }}
            {...props}
        >
            <Toolbar />
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
                    <Box>
                        <Datagrid>
                            <TextField source="cancellable.taxpayer.name" label="Razón social"/>
                            <TextField source="reason" label="Razón de anulación"/>
                            <TextField source="type.name" label="Tipo"/>
                            <TextField source="user.login" label="Login"/>
                            <RecordActions>
                                <ShowButton />
                            </RecordActions>
                        </Datagrid>
                    </Box>
                )
            }
        </ListBase>
    );
};

export default CancellationsList;
