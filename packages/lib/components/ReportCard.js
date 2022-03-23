import * as React from 'react';
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardContent from '@material-ui/core/CardContent';
import PropTypes from 'prop-types'
import OptionsCardMenu from '@approbado/lib/components/OptionsCardMenu';
import cardStyles from '@approbado/lib/styles/cardStyles'
import { ReactComponent as More } from '@approbado/lib/icons/More.svg'
import Typography from '@material-ui/core/Typography';
import Dot from '@approbado/lib/components/Dot';
import Box from '@material-ui/core/Box';
import Tag from '@approbado/lib/components/Tag';
import { ReactComponent as TagIcon } from '@approbado/lib/icons/Tag.svg'
import DeleteButton from '@approbado/lib/components/DeleteButton'
import { useHistory } from 'react-router-dom'
import { useConvertPostgresDate } from '@approbado/lib/hooks/useConvertPostgresDate'

const OptionsMenu = props => (
    <OptionsCardMenu icon={<More />}>
        <DeleteButton
            basePath='reports'
            confirmColor='warning'
            confirmTitle='Eliminar reporte'
            confirmContent={'¿Está seguro que desea eliminar este reporte?'}
            label={'Eliminar'}
            {...props}
        />
    </OptionsCardMenu>
);

const ReportCard = ({ data, id }) => {
    const classes = cardStyles();
    const history = useHistory();
    const date = useConvertPostgresDate(data.created_at)

    const handleRedirect = () => history.push(`/reports/${id}/show`)

    const { message, summary, type, owner } = data.post

    return (
        <Card className={classes.root} key={id} onClick={handleRedirect}>
            <CardHeader
                action={<OptionsMenu record={data} />}
                className={classes.cardHeader}
                title={
                    <Typography variant="subtitle1">
                        {(type == 'Comentario') ? summary : message}
                    </Typography>
                }
                subheader={
                    <Box display="flex" alignItems='center'>
                        <Typography variant="subtitle1">
                            {owner.user_name}
                        </Typography>
                        <Dot />
                        <Typography variant="subtitle1">
                            Reportado {data.reportsCount} veces
                        </Typography>
                    </Box>
                }
            />
            <CardContent>
                <Box display="flex" justifyContent="space-between">
                    <Tag name={type} icon={<TagIcon />} />
                    <Typography variant="body2" component="span">
                        {date}
                    </Typography>
                </Box>
            </CardContent>
        </Card>
    );
}

ReportCard.propTypes = {
    data: PropTypes.object,
    id: PropTypes.number
}

export default ReportCard
