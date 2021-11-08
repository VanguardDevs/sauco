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
import { useFileProvider } from '@jodaz_/file-provider'
import { fileProvider } from '@sauco/common/providers'

const ExportButton = (props: ExportButtonProps) => {
    const {
        onClick,
        label = 'ra.action.export',
        icon = defaultIcon,
        resource,
        sort, // deprecated, to be removed in v4
        ...rest
    } = props;
    const { total } = useListContext(props);
    const [provider, { loading, loaded }] = useFileProvider(fileProvider);

    const handleClick = React.useCallback(
        async (e) => {
            await provider({
                type: 'get',
                resource: resource,
                payload: {
                    name: 'reporte',
                    ext: 'pdf',
                    ...props
                }
            })
            e.preventDefault();
        },
        [props]
    );

    return (
        <Button
            onClick={handleClick}
            label={label}
            disabled={total === 0 || loading}
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
