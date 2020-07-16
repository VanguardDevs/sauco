import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';
import { useTable } from 'react-table';
// Components
import Portlet from '../../../components/Portlet';
import Col from '../../../components/Col';

const List = () => {
  const [models, setModels] = useState({});

  const data = useMemo(() => [
    { col1: 'Codigo', col2: 'Nombre', col3: 'Descripcion' },
  ], []);

  const columns = useMemo(() => [
    { header: 'Código', accessor: 'col1' },
    { header: 'Nombre', accessor: 'col2' },
    { header: 'Descripción', accessor: 'col3' }
  ], []); 

  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    rows,
    prepareRow
  } = useTable({ columns, data });

  useEffect(() => {
    axios.get('invoice-models')
      .then(res => setModels(res.data))
      .catch(err => console.log(err));
  }, []);

  return (
    <Col lg={12}>
      <Portlet
        label='Modelos de facturas'
      >
        <table {...getTableProps()} className="table table-bordered table-striped">
          <thead>
            {headerGroups.map(headerGroup => (
              <tr {...headerGroup.getHeaderGroupProps()}>
                {headerGroup.headers.map(column => (
                  <th {...column.getHeaderProps()}>
                    {column.render('header')}
                  </th>
                ))}
              </tr>
            ))}
          </thead>
          <tbody {...getTableBodyProps()}>
            {rows.map(row => {
              prepareRow(row)
              return (
                <tr {...row.getRowProps()}>
                  {row.cells.map(cell => {
                    return (
                      <td {...cell.getCellProps()}>
                        {cell.render('Cell')}
                      </td>
                    )
                  })}
                </tr>
              )
            })}
          </tbody>
        </table>
      </Portlet>
    </Col>
  );
};

export default List;
