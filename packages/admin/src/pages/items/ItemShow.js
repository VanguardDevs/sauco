import * as React from 'react'
import Box from '@mui/material/Box'
import { useParams } from 'react-router-dom'
import axios from '../../api'
import AssignmentIndIcon from '@mui/icons-material/AssignmentInd';
import LocalPhoneIcon from '@mui/icons-material/LocalPhone';
import TextField from '../../components/TextField';
import EmailIcon from '@mui/icons-material/Email';
import LinkIconButton from '../../components/LinkIconButton';
import LoadingIndicator from '../../components/LoadingIndicator'
import { setTitle, useAdmin } from '../../context/AdminContext'
import CubicleList from '../cubicles/CubicleList';

const CubicleShow = () => {
    const { dispatch } = useAdmin()
    const { id } = useParams();
    const [record, setRecord] = React.useState(null)

    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/items/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        fetchRecord()
    }, [])

    React.useEffect(() => {
        if (record) {
            setTitle(dispatch, `Rubro #${record.id}`)
        }
    }, [record])

    if (!record) return <LoadingIndicator />;

    return (
        <Box width='100%' height='100%'>
            <Box sx={{
                display: 'flex',
                backgroundColor: theme => theme.palette.secondary.main,
                padding: '1.5rem 1rem',
                borderRadius: 1,
                marginBottom: '1rem'
            }}>
                <Box sx={{
                    display: 'flex',
                    flexDirection: 'column',
                    flex: '1',
                }}>
                    <Box fontSize='1.1rem' fontWeight='600' textTransform={'uppercase'}>
                        {record.name}
                    </Box>
                    <Box fontSize='1rem' fontWeight='300'>
                        {record.cubicles_count ? (
                            <>
                                {record.cubicles_count} cubículo(s)
                            </>
                        ) : (<>Sin cubículos</>)}
                    </Box>
                </Box>
                <Box alignSelf='start'>
                    <LinkIconButton href={`/items/${record.id}/edit`} />
                </Box>
            </Box>
            <Box sx={{ fontWeight: 700, margin: '1rem 0', textTransform: 'uppercase', fontSize: '1.25rem' }}>Cubículos</Box>
            <CubicleList
                initialValues={{
                    item_id: id,
                }} 
                title={`Cubículos en el rubro "${record.name}"`}
            />
        </Box>
    )
}

export default CubicleShow
