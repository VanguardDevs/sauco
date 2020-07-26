import React, { useState, useEffect, useMemo } from 'react';
import { useTable, useSortBy } from 'react-table';

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
  } = useTable({ columns, data }, useSortBy);

  return (
    <div className='kt-datatable kt-datatable--default kt-datatable--scroll kt-datatable--loaded'>
      <table {...getTableProps()} className="kt-datatable__table">
        <thead className="kt-datatable__head">
          {headerGroups.map(headerGroup => (
            <tr {...headerGroup.getHeaderGroupProps()} className="kt-datatable__row">
              {headerGroup.headers.map(column => (
                <th {...column.getHeaderProps(column.getSortByToggleProps())} className="kt-datatable__cell" style={{rowStyle}}>
                  {column.render('header')}
                  {column.isSorted ? (column.isSortedDesc ? '  🔽' : '  🔼') : ''}
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

export default Table;
