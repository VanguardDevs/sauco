import { useCallback } from 'react';
import PropTypes from 'prop-types';
import DownloadIcon from '@material-ui/icons/GetApp';
import {
    useDataProvider,
    useNotify,
    useListContext,
    SortPayload,
    FilterPayload,
    useResourceContext,
    ButtonProps,
    Button
} from 'react-admin';
import { stringify } from 'qs';
import isEmpty from 'is-empty';
import axios from 'axios'
import fileDownload from 'js-file-download';

const token = localStorage.getItem(`${process.env.REACT_APP_AUTH_TOKEN_NAME}`);

const apiProvider = axios.create({
    baseURL: `${process.env.REACT_APP_API_DOMAIN}`,
    headers: {
        'Authorization': `Bearer ${token}`
    },
    responseType: 'blob'
})

const getUrl = (props: any) => {
    const { basePath, page, perPage, filterValues } = props;
    const query = {
        page: page,
        perPage: perPage,
        type: 'pdf'
    }

    // Add all filter params to query.
    Object.keys(filterValues || {}).forEach((key: any) => {
        //@ts-ignore
        query[`filter[${key}]`] = filterValues[key];
    });

    return `${basePath.substring(1)}?${stringify(query)}`;
}

const ExportButton = (props: ExportButtonProps) => {
    const {
        maxResults = 1000,
        onClick,
        label = 'ra.action.export',
        icon = defaultIcon,
        sort, // deprecated, to be removed in v4
        ...rest
    } = props;
    const {
        filter,
        filterValues,
        currentSort,
        total,
    } = useListContext(props);
    const resource = useResourceContext(props);
    const dataProvider = useDataProvider();
    const notify = useNotify();
    const handleClick = useCallback(
        event => {
            const URL = getUrl(props);

            apiProvider
                .get(`/${URL}`)
                .then((res: any) => {
                    const { data } = res

                    if (!isEmpty(data)) {
                        fileDownload(data, 'reporte.pdf');
                    }
                })
                .catch((error: any) => {
                    console.error(error);
                    notify('ra.notification.http_error', 'warning');
                });
            if (typeof onClick === 'function') {
                onClick(event);
            }
        },
        [
            currentSort,
            dataProvider,
            filter,
            filterValues,
            maxResults,
            notify,
            onClick,
            resource,
            sort,
        ]
    );

    return (
        <Button
            onClick={handleClick}
            label={label}
            disabled={total === 0}
            {...sanitizeRestProps(rest)}
        >
            {icon}
        </Button>
    );
};

const defaultIcon = <DownloadIcon />;

const sanitizeRestProps = ({
    basePath,
    filterValues,
    resource,
    ...rest
}: Omit<ExportButtonProps, 'sort' | 'maxResults' | 'label' | 'exporter'>) =>
    rest;

interface Props {
    basePath?: string;
    filterValues?: FilterPayload;
    icon?: JSX.Element;
    label?: string;
    maxResults?: number;
    onClick?: (e: Event) => void;
    resource?: string;
    sort?: SortPayload;
}

export type ExportButtonProps = Props & ButtonProps;

ExportButton.propTypes = {
    basePath: PropTypes.string,
    filterValues: PropTypes.object,
    label: PropTypes.string,
    maxResults: PropTypes.number,
    resource: PropTypes.string,
    sort: PropTypes.exact({
        field: PropTypes.string,
        order: PropTypes.string,
    }),
    icon: PropTypes.element,
};

export default ExportButton;
