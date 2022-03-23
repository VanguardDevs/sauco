import * as React from 'react'
import { ListBase } from 'react-admin'
import ReportCard from './ReportCard'
import ListContainer from '../components/ListContainer'
import Box from '@material-ui/core/Box';
import Spinner from '@approbado/lib/components/Spinner'
import { useListContext } from 'react-admin';
import Typography from '@material-ui/core/Typography';

const RecentReports = props => (
    <ListBase
        perPage={5}
        sort={{ field: 'created_at', order: 'DESC' }}
        {...props}
    >
        <RecentReportListView />
    </ListBase>
);

const LoadedList = ({ component }) => {
    const { ids, data, total } = useListContext();

    if (!ids || !data || !total) {
        return (
            <Typography variant="subtitle1">
                Aún no tenemos reportes
            </Typography>
        )
    }

    return (
        <Box>
            {ids.map((id, i) => (
                <Box>
                    {React.cloneElement(component, {
                        data: data[id],
                        id: id,
                        index: i,
                        key: id
                    })}
                </Box>
            ))}
        </Box>
    );
};

const RecentReportListView = props => {
    const { loaded } = useListContext();

    return loaded ? (
        <ListContainer
            list={<LoadedList component={<ReportCard />} />}
        />
    ) : (
        <Spinner />
    );
}

RecentReports.defaultProps = {
    basePath: 'reports',
    resource: 'reports'
}

export default RecentReports;
