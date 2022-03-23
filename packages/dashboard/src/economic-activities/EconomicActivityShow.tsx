import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import {
    useShowController,
    EditButton
} from 'react-admin';
import { EconomicActivity } from '@sauco/common/types';
import Box from '@material-ui/core/Box';
import TextFieldIcon from '@sauco/common/components/TextFieldIcon'
import EmojiSymbolsIcon from '@material-ui/icons/EmojiSymbols';
import IsoIcon from '@material-ui/icons/Iso';
import CardHeader from '@material-ui/core/CardHeader';
import RecordActions from '@sauco/common/components/RecordActions';

const EconomicActivityShow = (props: any) => {
    const { record } = useShowController<EconomicActivity>(props);
    const classes = useStyles();

    if (!record) return null;

    return (
        <Box className={classes.root}>
            <Card className={classes.header}>
                <CardHeader
                    action={
                        <RecordActions>
                            <EditButton resource="economic-activities" record={record} />
                        </RecordActions>
                    }
                    title={
                        <Typography variant="h6" gutterBottom align="left">
                            {record.name}
                        </Typography>
                    }
                    subheader={`Alícuota ${record.created_at}`}
                />
                <CardContent>
                    <Grid container spacing={2}>
                        <TextFieldIcon
                            text={`Alícuota ${record.aliquote}`}
                            icon={<EmojiSymbolsIcon />}
                        />
                        <TextFieldIcon
                            text={`Mínimo trib. ${record.min_tax}`}
                            icon={<IsoIcon />}
                        />
                    </Grid>
                </CardContent>
            </Card>
        </Box>
    );
};

export default EconomicActivityShow;

const useStyles = makeStyles(theme => ({
    root: { width: '100%' },
    header: {
        width: '100%'
    },
    spacer: { height: 20 },
}));
