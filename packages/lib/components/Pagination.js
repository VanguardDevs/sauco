import { useListContext } from 'react-admin';
import Button from '@material-ui/core/Button';
import Box from '@material-ui/core/Box';

// Icons
import { ReactComponent as LeftAngleIcon } from '@../icons/LeftAngle.svg'
import { ReactComponent as RightAngleIcon } from '@../icons/RightAngle.svg'

const Pagination = () => {
    const { page, perPage, total, setPage } = useListContext();
    const nbPages = Math.ceil(total / perPage) || 1;

    if (!total) return null

    return (
        <Box sx={{
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            padding: '1rem'
        }}>
            <Box>
                Página {page} de {nbPages}
            </Box>
                <Box>
                    {(page != 1) &&
                        <Button
                            color="primary.light"
                            key="prev"
                            onClick={() => setPage(page - 1)}
                            size='small'
                        >
                            <LeftAngleIcon />
                        </Button>
                    }
                    {(page != nbPages) &&
                        <Button
                            color="primary.light"
                            key="next"
                            onClick={() => setPage(page + 1)}
                            size='small'
                        >
                            <RightAngleIcon />
                        </Button>
                    }
                </Box>
        </Box>
    );
}

export default Pagination
