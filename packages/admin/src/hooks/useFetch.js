import * as React from 'react'
import axios from '../api'
import getQueryFromParams from '../utils/getQueryFromParams'

const useFetch = (url, params) => {
    const [loading, setLoading] = React.useState(true)
    const [error, setError] = React.useState(false)
    const [data, setData] = React.useState([])
    const [hasMore, setHasMore] = React.useState(null)
    const [total, setTotal] = React.useState(null)
    const {
        perPage,
        page,
        filter,
        sort
    } = params

    React.useEffect(() => {
        // if (hasMore == null || hasMore == true) {
            setLoading(true)
            setError(false)

            axios({
                method: 'GET',
                url: url,
                params: getQueryFromParams(params)
            }).then(res => {
                const { total: totalResults, data } = res.data

                if (total == null) {
                    setTotal(totalResults)
                }

                setData(data)
                setHasMore(data.length != totalResults)
                setLoading(false)
            }).catch(e => {
                setError(true)
            })
        // }
    }, [page, perPage, filter, sort])

    return { loading, error, data, hasMore, total }
}

export default useFetch
