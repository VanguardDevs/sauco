import { format } from 'date-fns';

export default (date) => 
  format(new Date(date), 'dd/MM/yyyy hh:mm bbbb');
