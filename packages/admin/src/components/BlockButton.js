import IconButton from '@mui/material/IconButton'
import BlockIcon from '@mui/icons-material/Block';
import { useConfirm } from 'material-ui-confirm';
import LockOpenIcon from '@mui/icons-material/LockOpen';

const BlockButton = ({
    title,
    onClick,
    active
}) => {
    const confirm = useConfirm();

    const handleClick = () => {
        confirm({ 
            title: title,
            cancellationText: 'Cancelar',
            confirmationText: 'Continuar'
        })
            .then(() => onClick())
    };

    return (
        <IconButton small onClick={handleClick}>
            {active ? <BlockIcon /> : <LockOpenIcon />}
        </IconButton>
    )
}

export default BlockButton
