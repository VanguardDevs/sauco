import * as React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { useInput, InputHelperText } from 'react-admin';
import { useDropzone } from 'react-dropzone';
import { ReactComponent as UploadIcon } from '@../icons/Upload.svg'
import Typography from '@material-ui/core/Typography'
import FormHelperText from '@material-ui/core/FormHelperText';

const useStyles = makeStyles(
    theme => ({
        dropZone: {
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'center',
            background: '#F9F9F9',
            cursor: 'pointer',
            textAlign: 'center',
            color: theme.palette.getContrastText(
                theme.palette.background.default
            ),
            border: `1px solid #B7B7B7`,
            borderRadius: '3px',
            width: '16rem',
            height: '16rem',
            border: 'none',
            opacity: props => props.loading ? 0.7 : 1,
            '& > *': {
                marginRight: '0.5rem',
                marginLeft: '0.5rem'
            }
        },
        thumb: {
            width: 'inherit',
            height: 'inherit',
            zIndex: 0
        },
        img: {
            height: 'inherit',
            width: 'inherit'
        },
        loader: {
            height: '1.25rem !important',
            width: '1.25rem !important'
        },
        className: {
            height: 'max-content',
            padding: '0.25rem 0'
        }
    }),
    { name: 'RaProfilePhotoInput' }
);

const ProfilePhotoInput = props => {
    const {
        accept,
        children,
        className,
        classes: classesOverride,
        format,
        maxSize,
        minSize,
        multiple = false,
        options: {
            inputProps: inputPropsOptions,
            ...options
        } = {},
        parse,
        placeholder,
        resource,
        source,
        validate,
        preview,
        loading,
        helperText,
        hasPreview = false,
        ...rest
    } = props;
    const classes = useStyles(props);
    const [file, setFile] = React.useState({ preview: preview, hasPreview: hasPreview });

    // turn a browser dropped file structure into expected structure
    const transformFile = file => {
        if (!(file instanceof File)) {
            return file;
        }

        const { source, title } = (React.Children.only(children)).props;

        const preview = URL.createObjectURL(file);
        const transformedFile = {
            rawFile: file,
            [source]: preview,
        };
        setFile({ preview: preview, hasPreview: true })

        if (title) {
            transformedFile[title] = file.name;
        }

        return transformedFile;
    };

    const {
        id,
        input: { onChange, value, ...inputProps },
        meta
    } = useInput({
        format: format || transformFile,
        parse: parse || transformFile,
        source,
        type: 'file',
        validate,
        ...rest,
    });
    const { touched, error, submitError } = meta;

    const onDrop = (newFiles, rejectedFiles, event) => {
        const updatedFiles = [...newFiles];
        onChange(updatedFiles[0]);

        if (options.onDrop) {
            options.onDrop(newFiles, rejectedFiles, event);
        }
    };

    const { getRootProps, getInputProps } = useDropzone({
        ...options,
        accept,
        maxSize,
        minSize,
        multiple,
        onDrop,
    });

    React.useEffect(() => () => {
        // Make sure to revoke the data uris to avoid memory leaks
        URL.revokeObjectURL(file.preview)
    }, [file]);

    return (
        <>
            <div
                data-testid="dropzone"
                className={classes.dropZone}
                {...getRootProps()}
            >
                {(!file.hasPreview) ? (
                    <>
                        <UploadIcon />
                        <input
                            id={id}
                            {...getInputProps({
                                ...inputProps,
                                ...inputPropsOptions,
                            })}
                        />
                        <Typography variant="subtitle1" component="span">
                        {'Selecciona una foto desde tu dispositivo'}
                        </Typography>
                    </>
                ) : (
                    <img
                        className={classes.img}
                        src={file.preview}
                    />
                )}
            </div>
        </>
    );
};

ProfilePhotoInput.defaultProps = {
    children: <></>
}

export default ProfilePhotoInput;
