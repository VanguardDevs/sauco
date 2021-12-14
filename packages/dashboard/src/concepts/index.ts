import LocalGroceryStoreIcon from '@material-ui/icons/LocalGroceryStore'
import ConceptsList from './ConceptList'
import ConceptCreate from './ConceptCreate'

export default {
  name: 'concepts',
  icon: LocalGroceryStoreIcon,
  list: ConceptsList,
  create: ConceptCreate,
  options: {
    label: 'Conceptos'
  }
}
