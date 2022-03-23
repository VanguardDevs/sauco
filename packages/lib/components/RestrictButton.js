import * as React from 'react'
import { fade } from '@material-ui/core'
import styled from '@material-ui/styles/styled';
import { useMutation, useNotify, useRedirect } from 'react-admin'
import Button from '@material-ui/core/Button';
import Confirm from '@approbado/lib/layouts/Confirm';

const CustomizedButton = styled(Button)(({ theme }) => ({
    backgroundColor: theme.palette.background.dark,
    border: '1px solid #B7B7B7 !important',
    '&:hover': {
        backgroundColor: fade(theme.palette.background.dark, 0.9)
    }
}));

const RestrictButton = user => {
    const redirect = useRedirect();
    const notify = useNotify()
    const [open, setOpen] = React.useState(false);
    const [mutate, { loaded, loading }] = useMutation();

    const handleClick = React.useCallback(async () => {
        try {
            await mutate({
                type: 'update',
                resource: 'blacklisted-users',
                payload: { id: user.id, data: { user_id: user.id, is_restricted: true } }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate, user])

    React.useEffect(() => {
        if (loaded) {
            redirect(`reports?tab=blacklisted`)
            notify(`¡El usuario @${user.user_name} ahora está en la lista negra!`, 'success')
        }
    }, [loaded])

    return (
        <>
            <CustomizedButton size='large' color="pimary" onClick={() => setOpen(!open)}>
                Restringir acceso
            </CustomizedButton>
            <Confirm
                isOpen={open}
                loading={loading}
                title='Restringir acceso'
                content={`¿Está seguro que desea restringir el acceso a ${user.user_name}?`}
                onConfirm={handleClick}
                onClose={() => setOpen(!open)}
                confirmColor='primary'
                confirm='Sí'
            />
        </>
    )
}

export default RestrictButton
