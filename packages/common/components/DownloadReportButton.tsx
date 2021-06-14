import * as React from 'react';
import fileDownload from 'js-file-download';
import { useNotify, Button } from 'react-admin';
import isEmpty from 'is-empty';
import { stringify } from 'qs';
import axios from 'axios';
import PrintIcon from '@material-ui/icons/Print';

const getUrl = (props: any) => {
    const { basePath, page, perPage, filterValues } = props;
    const query = {
        page: page,
        perPage: perPage,
        type: 'pdf'
    }

    // Add all filter params to query.
    Object.keys(filterValues || {}).forEach((key) => {
        query[`filter[${key}]`] = filterValues[key];
    });

    return `${basePath.substring(1)}?${stringify(query)}`;
}

const DownloadReportButton: React.FC<any> = props => {
    const notify = useNotify();

    const handleDownload = React.useCallback(async () => {
        const url = getUrl(props);
        notify('Estamos procesando su solicitud.');
        const res = await axios.get(`${process.env.REACT_APP_API_DOMAIN}/${url}`, { responseType: 'blob'})
            .then(res => res.data);

        if (!isEmpty(res)) {
            fileDownload(res, 'reporte.pdf');
            notify('Reporte descargado.');
        }
    }, [props]);

    return (
        <Button
            onClick={() => handleDownload()}
            label='Descargar'
        >
            <PrintIcon />
        </Button>
    );
}

export default DownloadReportButton
