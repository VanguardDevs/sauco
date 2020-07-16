import React, { useState, useEffect, useMemo } from 'react';
import { useTable } from 'react-table';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';
import Col from '../../../components/Col';

const Table = ({ columns, data }) => {
  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    rows,
    prepareRow
  } = useTable({ columns, data });

  return (
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
  );
};

const List = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('invoice-models')
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, [data]);

  const columns = useMemo(() => [
    { header: 'Código', accessor: 'code' },
    { header: 'Nombre', accessor: 'name' },
    { header: 'Descripción', accessor: 'description' }
  ], []);

  return (
    <Col lg={12}>
      <Portlet label='Modelos de facturas'>
        {(loading) ? (
          <Loading />
        ) : (
          <Table columns={columns} data={data} />
        )}
      </Portlet>
    </Col>
  );
};

export default List;
