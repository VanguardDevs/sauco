import * as React from 'react';
import ContactMailIcon from '@material-ui/icons/ContactMail';
import ConceptsList from './List';

export default {
  name: 'concepts',
  icon: ContactMailIcon,
  list: ConceptsList,
  options: {
    label: 'Conceptos'
  }
}