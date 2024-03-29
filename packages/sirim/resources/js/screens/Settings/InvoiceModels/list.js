import React, { useState, useEffect, useMemo } from 'react';
import { useTable } from 'react-table';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';
import Col from '../../../components/Col';

const rowStyle = {
  'left': '0px'
};

const Table = ({ columns, data }) => {
  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    rows,
    prepareRow
  } = useTable({ columns, data });

  return (
    <div className='kt-datatable kt-datatable--default kt-datatable--scroll kt-datatable--loaded'>
      <table {...getTableProps()} className="kt-datatable__table">
        <thead className="kt-datatable__head">
          {headerGroups.map(headerGroup => (
            <tr {...headerGroup.getHeaderGroupProps()} className="kt-datatable__row">
              {headerGroup.headers.map(column => (
                <th {...column.getHeaderProps()} className="kt-datatable__cell" style={{rowStyle}}>
                  {column.render('header')}
                </th>
              ))}
            </tr>
          ))}
        </thead>
        <tbody {...getTableBodyProps()} className="kt-datatable__body">
          {rows.map(row => {
            prepareRow(row)
            return (
              <tr {...row.getRowProps()} className="kt-datatable__row" style={{rowStyle}}>
                {row.cells.map(cell => {
                  return (
                    <td {...cell.getCellProps()} className="kt-datatable__cell">
                      {cell.render('Cell')}
                    </td>
                  )
                })}
              </tr>
            )
          })}
        </tbody>
      </table>
    </div>
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
