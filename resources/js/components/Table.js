import React, { useState, useEffect, useMemo } from 'react';
import { useTable, useSortBy, usePagination } from 'react-table';

const rowStyle = {
  'left': '0px'
};

const Table = ({ columns, data }) => {
  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    page,
    prepareRow,
    canPreviousPage,
    canNextPage,
    pageOptions,
    pageCount,
    gotoPage,
    nextPage,
    previousPage,
    setPageSize,
    state: { pageIndex, pageSize },
  } = useTable({ 
    columns,
    data,
    initialState: { pageIndex: 0 },
  }, 
    useSortBy, 
    usePagination
  );

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
          {page.map(row => {
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
      
      <div className="kt-datatable__pager kt-datatable--paging-loaded">
        <ul className="kt-datatable__pager-nav">
          <button onClick={() => gotoPage(0)} disabled={!canPreviousPage}>
            {'<<'}
          </button>{' '}
          <button onClick={() => previousPage()} disabled={!canPreviousPage}>
            {'<'}
          </button>{' '}
          <button onClick={() => nextPage()} disabled={!canNextPage}>
            {'>'}
          </button>{' '}
          <button onClick={() => gotoPage(pageCount - 1)} disabled={!canNextPage}>
            {'>>'}
          </button>{' '}
        </ul>
        <div className="kt-datatable__pager-info">
          <span>
            Página{' '}
            <strong>
              {pageIndex + 1} de {pageOptions.length}
            </strong>{' '}
          </span>
          <span>
            | Ir a:{' '}
            <input
              type="number"
              defaultValue={pageIndex + 1}
              onChange={e => {
                const page = e.target.value ? Number(e.target.value) - 1 : 0
                gotoPage(page)
              }}
              style={{ width: '100px' }}
            />
          </span>{' '}
          <select
            value={pageSize}
            onChange={e => {
              setPageSize(Number(e.target.value))
            }}
          >
            {[10, 20, 30, 40, 50].map(pageSize => (
              <option key={pageSize} value={pageSize}>
                Mostrando {pageSize} resultados
              </option>
            ))}
          </select>
        </div>
      </div>
    </div>
  );
};

export default Table;
