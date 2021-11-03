import * as React from 'react';
import PropTypes from 'prop-types';
import DownloadIcon from '@material-ui/icons/GetApp';
import {
    useListContext,
    SortPayload,
    FilterPayload,
    ButtonProps,
    Button
} from 'react-admin';
import { fileProvider } from '@sauco/common/providers'

const ExportButton = (props: ExportButtonProps) => {
    const {
        maxResults = 1000,
        onClick,
        label = 'ra.action.export',
        icon = defaultIcon,
        sort, // deprecated, to be removed in v4
        ...rest
    } = props;
    const { total } = useListContext(props);
    const downloader = fileProvider({
        apiUrl: `${process.env.REACT_APP_API_DOMAIN}`,
        tokenName: `${process.env.REACT_APP_AUTH_TOKEN_NAME}`,
        fileName: 'reporte-de-pagos.pdf',
        ...props
    })

    const handleClick = React.useCallback(
        event => {
            downloader.getFile()
        },
        [downloader]
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
