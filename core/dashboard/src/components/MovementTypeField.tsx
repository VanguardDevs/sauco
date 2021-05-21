import * as React from "react";

interface Props {
  label?: string,
  record?: any
}

const MovementTypeField: React.FC<Props> = ({ record, label }) => (
  <div>
    {record.concurrent ? 'Simultáneo' : 'Moroso'}
  </div>
);

export default MovementTypeField;
