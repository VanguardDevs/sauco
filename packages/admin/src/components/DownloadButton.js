import IconButton from '@mui/material/IconButton'
import PrintIcon from '@mui/icons-material/Print';
import download from '../utils/download';

const PrintButton = ({
    basePath,
    filename,
    type,
    title = null,
    ...params
}) => {
    const handleClick = () => download(basePath, {
        ...params,
        type: type
    }, filename, title);

    return (
        <IconButton small onClick={handleClick}>
            <PrintIcon />
        </IconButton>
    )
}

export default PrintButton
