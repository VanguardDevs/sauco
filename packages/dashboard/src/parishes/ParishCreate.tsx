import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    SaveButton,
    useCreateController,
    CreateContextProvider,
    CreateProps,
    ReferenceInput,
    SelectInput
} from 'react-admin'
import { Box, Grid, InputLabel, Card } from '@material-ui/core'
import { useFormState } from 'react-final-form'
import validate from './validateParishes'

const MunicipalitiesSelectInput = (props: any) => {
    const { values } = useFormState();

    if (values.state_id) {
        return (
            <Grid item xs={12} sm={12} md={4}>
                <InputLabel>Municipio</InputLabel>
                <ReferenceInput
                    source="municipality_id"
                    reference="municipalities"
                    sort={{ field: 'id', order: 'ASC' }}
                    label=''
                    filter={{ state_id: values.state_id }}
                    fullWidth
                >
                    <SelectInput source="name" />
                </ReferenceInput>
            </Grid>
        )
    }

    return null;
}

const ParishCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Nombre</InputLabel>
                            <TextInput
                                label={false}
                                source="name"
                                placeholder="Ej. María Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Estado</InputLabel>
                            <ReferenceInput
                                source="state_id"
                                reference="states"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput source="name" />
                            </ReferenceInput>
                        </Grid>
                        <MunicipalitiesSelectInput />
                    </Grid>
                    <SaveButton
                        handleSubmitWithRedirect={
                            handleSubmitWithRedirect
                        }
                        saving={saving}
                    />
                </Box>
            </Card>
        )}
    />
);

const ParishCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);

    const { save } = createControllerProps;

    return (
        <CreateContextProvider value={createControllerProps}>
            <ParishCreateForm save={save} validate={validate} />
        </CreateContextProvider>
    )
}

export default ParishCreate
