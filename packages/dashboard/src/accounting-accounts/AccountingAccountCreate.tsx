import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    SaveButton,
    useCreateController,
    useMutation,
    CreateContextProvider,
    CreateProps,
    ReferenceInput,
    SelectInput,
    useRedirect,
    useNotify
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

const AccountingAccountCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Nueva cuenta contable'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={12}>
                            <InputLabel>Nombre</InputLabel>
                            <TextInput
                                label={false}
                                source="name"
                                placeholder="Ejemplo: Lic. Pérez Quijada"
                                fullWidth
                            />
                        </Grid>
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

const AccountingAccountCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);
    const [mutate, { data, loaded }] = useMutation();
    const redirect = useRedirect();
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'create',
                resource: props.resource,
                payload: { data: values }
            }, { returnPromise: true })
        } catch (error: any) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (data && loaded) {
            notify('¡Ha creado una cuenta contable!', 'success');
            redirect(`/accounting-accounts`)
        }
    }, [data, loaded]);

    return (
        <CreateContextProvider value={createControllerProps}>
            <AccountingAccountCreateForm save={save} />
        </CreateContextProvider>
    )
}

export default AccountingAccountCreate
