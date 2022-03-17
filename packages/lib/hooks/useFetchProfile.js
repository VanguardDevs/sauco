import * as React from 'react'
import { axios } from '../providers'

const useFetchProfile = () => {
    const [record, setRecord] = React.useState({})
    const [isLoading, setIsLoading] = React.useState(false);
    const [url, setUrl] = React.useState('profile');
    const [isError, setIsError] = React.useState(false);

    React.useEffect(() => {
        const fetchData = async () => {
            setIsError(false);
            setIsLoading(true);

            try {
                const result = await axios.get(url);

                setRecord(result.data);
            } catch (error) {
                setIsError(true);
            }

            setIsLoading(false);
        };

        fetchData();
    }, [url]);

    return [{ record, isLoading, isError }, setUrl];
}

export default useFetchProfile;
