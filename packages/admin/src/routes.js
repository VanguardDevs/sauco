import HomeIcon from '@mui/icons-material/Home';
import FiberManualRecordIcon from '@mui/icons-material/FiberManualRecord';
import BusinessCenterIcon from '@mui/icons-material/BusinessCenter';
import AddBusinessIcon from '@mui/icons-material/AddBusiness';

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
        icon: <BusinessCenterIcon />
    },
    {
        name: 'Vehículos',
        route: '/vehicles',
        icon: <BusinessCenterIcon />
    },
    {
        name: 'Cubículos',
        route: '/cubicles',
        icon: <AddBusinessIcon />
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
        route: '/users',
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
    }
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
