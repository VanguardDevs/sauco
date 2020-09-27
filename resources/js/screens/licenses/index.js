import React, { useState, useEffect } from 'react';
import {
  Grid,
  Container,
  CardHeader,
  Box,
  IconButton,
  makeStyles,
  useTheme,
} from '@material-ui/core';
import MUIDataTable from 'mui-datatables';
import Layout from '../../layouts';
import { useFetch } from '../../utils';

export default function Licenses() {
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(5);
  const [data, setData] = useState([]);
  const { response, error, isLoading } = useFetch(`licenses?results=${rowsPerPage}`);

  useEffect(() => {
    if (!isLoading) {
      const data = response.map(row => [
        row.num,
        row.emission_date,
        row.taxpayer.name
      ]);
      setData(data);
    }
  }, [isLoading]);

  const columns = ['Número', 'Fecha de emision', 'Empresa'];

  return (
    <Layout title='Licencias'>
      <Box>
        <CardHeader title='Licencias' />
      </Box>
      { (isLoading) 
        ? <>Cargando...</>
        : (
          <MUIDataTable
            serverSide
            columns={columns}
            data={data}
          />
        )
      }
    </Layout>
  );
};

