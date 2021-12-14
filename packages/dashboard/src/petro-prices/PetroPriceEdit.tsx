import * as React from 'react'
import {
    NumberInput,
    FormWithRedirect,
    SaveButton,
    useEditController,
    useMutation,
    EditContextProvider,
    EditProps,
    useRedirect,
    useNotify
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

const PetroPriceEditForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Editar valor del petro'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={6}>
                            <InputLabel>Valor (Bs)</InputLabel>
                            <NumberInput
                                label={false}
                                source="value"
                                placeholder="Ejemplo: 260.900,99"
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

const PetroPriceEdit: React.FC<any> = (props: EditProps) => {
    const editControllerProps = useEditController(props);
    const [mutate, { data, loaded }] = useMutation();
    const redirect = useRedirect();
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'update',
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
            notify('¡Se ha actualizado la firma de manera exitosa!', 'success');
            redirect(`PetroPrices`)
        }
    }, [data, loaded]);

    return (
        <EditContextProvider value={editControllerProps}>
            <PetroPriceEditForm {...editControllerProps} />
        </EditContextProvider>
    )
}

export default PetroPriceEdit
