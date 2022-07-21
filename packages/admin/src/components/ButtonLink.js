import Button from '@mui/material/Button'
import LinkBehavior from '../components/LinkBehavior';

const ButtonLink = ({ href, children, ...restProps}) => (
    <Button
        component={LinkBehavior}
        to={href}
        {...restProps}
    >
        {children}
    </Button>
)

ButtonLink.defaultProps = {
    children: 'Crear'
}

export default ButtonLink
