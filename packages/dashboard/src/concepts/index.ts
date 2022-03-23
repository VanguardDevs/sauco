import LocalGroceryStoreIcon from '@material-ui/icons/LocalGroceryStore'
import ConceptsList from './ConceptList'
import ConceptCreate from './ConceptCreate'
import ConceptEdit from './ConceptEdit'

export default {
  name: 'concepts',
  icon: LocalGroceryStoreIcon,
  list: ConceptsList,
  edit: ConceptEdit,
  create: ConceptCreate,
  options: {
    label: 'Conceptos'
  }
}
