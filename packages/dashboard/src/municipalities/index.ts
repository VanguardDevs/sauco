import MunicipalitiesList from './MunicipalitiesList'
import LocationCityIcon from '@material-ui/icons/LocationCity';
import MunicipalityCreate from './MunicipalityCreate'
import MunicipalityEdit from './MunicipalityEdit'

export default {
  name: 'municipalities',
  icon: LocationCityIcon,
  list: MunicipalitiesList,
  create: MunicipalityCreate,
  edit: MunicipalityEdit,
  options: {
    label: 'Municipios'
  }
}
