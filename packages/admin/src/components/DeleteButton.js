import IconButton from '@mui/material/IconButton'
import DeleteIcon from '@mui/icons-material/Delete';
import { useConfirm } from 'material-ui-confirm';

const DeleteButton = ({
    title,
    onClick
}) => {
    const confirm = useConfirm();

    const handleClick = () => {
        confirm({ 
            title: title,
            cancellationText: 'Cancelar',
            confirmationText: 'Continuar',
            description: '¡Esta acción es permanente!'
        })
            .then(() => onClick())
    };

    return (
        <IconButton small onClick={handleClick}>
            <DeleteIcon />
        </IconButton>
    )
}

export default DeleteButton
