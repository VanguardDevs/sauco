const palette = {
    primary: {
        main: '#3F51B5',
    },
    secondary: {
        light: '#C5CAE9',
        main: '#448AFF',
        dark: '#303F9F',
        contrastText: '#fff',
    },
    text: {
        primary: '#212121',
        secondary: '#757575',
        divider: '#BDBDBD'
    },
    background: {
        default: '#fcfcfe',
    },
}

export default {
    palette: palette,
    shape: {
        borderRadius: 10,
    },
    overrides: {
        RaList: {
          content: {
            borderRadius: 0
          }
        },
        RaMenuItemLink: {
            root: {
                borderLeft: '3px solid #fff',
            },
            active: {
                borderLeft: `3px solid ${palette.secondary.main}`,
            },
        },
        MuiInputBase: {
            root: {
                borderRadius: '0'
            },
            input: {
              padding: '10px 12px !important',
              fontSize: 16,
              border: '1px solid #ced4da',
              transition: "none",
              borderRadius: '0'
            }
        },
        MuiPaper: {
            elevation1: {
                boxShadow: 'none',
            },
            root: {
                border: '1px solid #e0e0e3',
                backgroundClip: 'padding-box',
            },
            rounded: {
                borderRadius: '0 !important'
            }
        },
        MuiButton: {
            contained: {
                backgroundColor: '#fff',
                color: `${palette.secondary.main}`,
                boxShadow: 'none',
                borderRadius: '0 !important'
            },
        },
        MuiButtonBase: {
            root: {
                '&:hover:active::after': {
                    // recreate a static ripple color
                    // use the currentColor to make it work both for outlined and contained buttons
                    // but to dim the background without dimming the text,
                    // put another element on top with a limited opacity
                    content: '""',
                    display: 'block',
                    width: '100%',
                    height: '100%',
                    position: 'absolute',
                    top: 0,
                    right: 0,
                    backgroundColor: 'currentColor',
                    opacity: 0.3,
                    borderRadius: 0,
                },
            },
        },
        MuiAppBar: {
            colorSecondary: {
                color: '#808080',
                backgroundColor: '#fff',
            },
        },
        MuiLinearProgress: {
            colorPrimary: {
                backgroundColor: '#f5f5f5',
            },
            barColorPrimary: {
                backgroundColor: '#d7d7d7',
            },
        },
        MuiFilledInput: {
            root: {
                backgroundColor: 'rgba(0, 0, 0, 0.04)',
                borderRadius: '0',
                '&$disabled': {
                    backgroundColor: 'rgba(0, 0, 0, 0.04)',
                },
            },
        },
        MuiSnackbarContent: {
            root: {
                border: 'none',
            },
        },
    },
    props: {
        MuiButtonBase: {
            // disable ripple for perf reasons
            disableRipple: true,
        },
    },
};
