import * as React from 'react';
import PropTypes from 'prop-types';
import DownloadIcon from '@material-ui/icons/GetApp';
import {
    useListContext,
    SortPayload,
    FilterPayload,
    ButtonProps,
    Button,
    useNotify
} from 'react-admin';
import { useFileProvider } from '@jodaz_/file-provider'
import { fileProvider } from '@sauco/common/providers'

const ExportButton = (props: ExportButtonProps) => {
    const {
        onClick,
        resource = 'string',
        sort, // deprecated, to be removed in v4
        ...rest
    } = props;
    const { total } = useListContext(props);
    const [provider, { loading }] = useFileProvider(fileProvider);
    const notify = useNotify();

    const handleClick = React.useCallback(async () => {
        try {
            await provider({
                type: 'list',
                resource: resource,
                payload: {
                    name: `reporte-${props.downloableName}`,
                    ext: 'pdf',
                    ...props
                }
            })
        } catch (error) {
            console.log(error)
        }
    }, [props]);

    React.useEffect(() => {
        if (loading) notify('Espere mientras procesamos su reporte.', 'info');
    }, [loading]);

    return (
        <Button
            onClick={handleClick}
            label='Descargar'
            disabled={total === 0 || loading}
            {...sanitizeRestProps(rest)}
        >
            <DownloadIcon />
        </Button>
    );
};

const sanitizeRestProps = ({
    basePath,
    filterValues,
    resource,
    ...rest
}: Omit<ExportButtonProps, 'sort' | 'maxResults' | 'label' | 'exporter' | 'downloableName'>) =>
    rest;

interface Props {
    basePath?: string;
    filterValues?: FilterPayload;
    label?: string;
    maxResults?: number;
    onClick?: (e: Event) => void;
    resource?: string;
    sort?: SortPayload;
    downloableName?: string;
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
    downloableName: PropTypes.string
};

export default ExportButton;
