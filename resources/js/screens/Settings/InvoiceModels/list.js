import React, { useState, useEffect, useMemo } from 'react';
import { useTable } from 'react-table';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';
import Col from '../../../components/Col';

const List = props => {
  const [models, setModels] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('invoice-models')
      .then(res => setModels(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const data = useMemo(() => [
    { col1: models.code, col2: models.name, col3: models.description },
  ], [models]);

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

  return (
    <Col lg={12}>
      <Portlet
        label='Modelos de facturas'
      > {(!loading) ? (
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
        ) : (
          <Loading />
        )}
      </Portlet>
    </Col>
  );
};

export default List;
