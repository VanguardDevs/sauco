import HomeIcon from '@mui/icons-material/Home';
import FiberManualRecordIcon from '@mui/icons-material/FiberManualRecord';
import StorefrontIcon from '@mui/icons-material/Storefront';
import BusinessCenterIcon from '@mui/icons-material/BusinessCenter';
import LiquorIcon from '@mui/icons-material/Liquor';
import DirectionsCarIcon from '@mui/icons-material/DirectionsCar';

const AdminIcon = () => (
    <FiberManualRecordIcon sx={{
        color: theme => theme.palette.primary.main,
        marginLeft: '1rem',
        paddingRight: '-1rem',
        fontSize: '0.7rem'
    }} />
)

export const routes = [
    {
        name: 'Inicio',
        route: '/',
        icon: <HomeIcon />
    },
    {
        name: 'Contribuyentes',
        route: '/taxpayers',
        icon: <BusinessCenterIcon />
    },
    {
        name: 'Expendios',
        route: '/liqueurs',
        icon: <LiquorIcon />
    },
    {
        name: 'Vehículos',
        route: '/vehicles',
        icon: <DirectionsCarIcon />
    },
    {
        name: 'Cubículos',
        route: '/cubicles',
        icon: <StorefrontIcon />
    }
]

export const adminRoutes = [
    {
        name: 'Usuarios',
        route: '/users',
        icon: <AdminIcon />
    },
    {
        name: 'Roles',
        route: '/roles',
        icon: <AdminIcon />
    },
    {
        name: 'Permisos',
        route: '/permissions',
        icon: <AdminIcon />
    },
]

export const geographicArea = [
    {
        name: 'Estados',
        route: '/states',
        icon: <AdminIcon />
    },
    {
        name: 'Municipios',
        route: '/municipalities',
        icon: <AdminIcon />
    },
    {
        name: 'Parroquias',
        route: '/parishes',
        icon: <AdminIcon />
    },
    {
        name: 'Comunidades',
        route: '/communities',
        icon: <AdminIcon />
    },
]

export const rates = [
    {
        name: 'Actividades',
        route: '/economic-activities',
        icon: <AdminIcon />
    },
    {
        name: 'Conceptos',
        route: '/concepts',
        icon: <AdminIcon />
    },
    {
        name: 'Petro',
        route: '/petro-prices',
        icon: <AdminIcon />
    },
    {
        name: 'Parámetros de expendios',
        route: '/liqueur-parameters',
        icon: <AdminIcon />
    },
    {
        name: 'Parámetros de vehículos',
        route: '/vehicle-parameters',
        icon: <AdminIcon />
    },
]

export const reports = [
    {
        name: 'Pagos',
        route: '/payments',
        icon: <AdminIcon />
    },
    {
        name: 'Liquidaciones',
        route: '/liquidations',
        icon: <AdminIcon />
    },
    {
        name: 'Retenciones',
        route: '/deductions',
        icon: <AdminIcon />
    },
    {
        name: 'Sanciones y multas',
        route: '/fines',
        icon: <AdminIcon />
    },
    {
        name: 'Anulaciones',
        route: '/cancellations',
        icon: <AdminIcon />
    },
    {
        name: 'Licencias',
        route: '/licenses',
        icon: <AdminIcon />
    },
    {
        name: 'Solicitudes',
        route: '/applications',
        icon: <AdminIcon />
    },
    {
        name: 'Declaraciones',
        route: '/affidavits',
        icon: <AdminIcon />
    },
    {
        name: 'Movimientos',
        route: '/movements',
        icon: <AdminIcon />
    }
]

export const settings = [
    {
        name: 'Rubros',
        route: '/items',
        icon: <AdminIcon />
    },
    {
        name: 'Tipos de liquidaciones',
        route: '/liquidation-types',
        icon: <AdminIcon />
    },
    {
        name: 'Tipos de pago',
        route: '/payment-types',
        icon: <AdminIcon />
    },
    {
        name: 'Ordenanzas',
        route: '/ordinances',
        icon: <AdminIcon />
    },
    {
        name: 'Marcas de vehículos',
        route: '/vehicle-models',
        icon: <AdminIcon />
    },
    {
        name: 'Modelos de vehículos',
        route: '/vehicle-models',
        icon: <AdminIcon />
    },
    {
        name: 'Colores',
        route: '/colors',
        icon: <AdminIcon />
    },
    {
        name: 'Anexos de expendios',
        route: '/annexes',
        icon: <AdminIcon />
    },
    {
        name: 'Métodos de pago',
        route: '/payment-methods',
        icon: <AdminIcon />
    },
    {
        name: 'Firmas',
        route: '/signatures',
        icon: <AdminIcon />
    },
    {
        name: 'Cuentas contables',
        route: '/accounting-accounts',
        icon: <AdminIcon />
    }
]
