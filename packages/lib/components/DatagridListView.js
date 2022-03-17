import * as React from 'react'
import { FilterContext, useListContext } from 'react-admin'
import ListContainer from '../components/ListContainer'
import EmptyMessageComponent from '@../components/EmptyMessageComponent'
import Spinner from '@../components/Spinner'

const DatagridListView = ({ datagrid, actions }) => {
    const { loading, total, ids, data } = useListContext({
        basePath: 'configurations/levels',
        resource: 'configurations/levels'
    });
    console.log(loading)
    return (
        <ListContainer
            actions={
                <FilterContext.Provider>
                    {actions}
                </FilterContext.Provider>
            }
            list={
                (loading) ? <Spinner />
                : (!ids || !data || !total)
                    ? <EmptyMessageComponent message='Sin registros'  />
                    : <>{datagrid}</>
            }
        />
    )
};

export default DatagridListView
