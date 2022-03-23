import * as React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { useInput } from 'react-admin';
import { useDropzone } from 'react-dropzone';
import Avatar from '@material-ui/core/Avatar'
import { ReactComponent as PhotoIcon } from '@../icons/Photo.svg'

const useStyles = makeStyles(
    theme => ({
        dropZone: {
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            background: 'transparent',
            cursor: 'pointer',
            textAlign: 'center',
            color: theme.palette.getContrastText(
                theme.palette.background.default
            ),
            border: `1px solid #B7B7B7`,
            borderRadius: '50%',
            '& > *': {
                marginRight: '0.5rem',
                marginLeft: '0.5rem'
            },
            height: '7.5rem',
            width: '7.5rem',
            transition: '0.5s',
            '&:hover': {
                opacity: '0.9'
            },
            zIndex: 10,
            position: 'relative',
            opacity: props => props.disabled ? 0.7 : 1
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
        icon: {
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
            width: '1rem',
            height: '1rem',
            padding: '0.5rem',
            borderRadius: '50%',
            background: theme.palette.info.main,
            zIndex: 1000,
            position: 'absolute',
            bottom: 0,
            right: 0,
            border: '2px solid #fff',
            color: '#fff'
        }
    }),
    { name: 'RaProfilePhotoInput' }
);

const filePreviewOrigin = filepath => (`${process.env.REACT_APP_API_DOMAIN}/${filepath}`)

const ProfilePhotoInput = props => {
    const {
        accept,
        children,
        className,
        classes: classesOverride,
        format,
        helperText,
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
        disabled,
        ...rest
    } = props;
    const classes = useStyles(props);
    const [file, setFile] = React.useState({ preview: filePreviewOrigin(preview) });

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
        setFile({ preview: preview })

        if (title) {
            transformedFile[title] = file.name;
        }

        return transformedFile;
    };

    const {
        id,
        input: { onChange, value, ...inputProps }
    } = useInput({
        format: format || transformFile,
        parse: parse || transformFile,
        source,
        type: 'file',
        validate,
        ...rest,
    });

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

    const thumbs = () => (
        <Avatar
            className={classes.img}
            src={file.preview}
        />
    );

    React.useEffect(() => () => {
      // Make sure to revoke the data uris to avoid memory leaks
      URL.revokeObjectURL(file.preview)
    }, [file]);

    return (
        <div
            data-testid="dropzone"
            className={classes.dropZone}
            {...getRootProps()}
        >
            <input
                id={id}
                {...getInputProps({
                    ...inputProps,
                    ...inputPropsOptions,
                })}
            />
            {thumbs()}
            <div className={classes.icon}>
                <PhotoIcon />
            </div>
        </div>
    );
};

ProfilePhotoInput.defaultProps = {
    children: <></>
}

export default ProfilePhotoInput;
