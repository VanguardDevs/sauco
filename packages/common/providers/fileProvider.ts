import axios from 'axios'
import { stringify } from 'qs';
import fileDownload from 'js-file-download';
import isEmpty from 'is-empty';

const interceptors = (instance: any, tokenName: string) => {
    // Request interceptor
    instance.interceptors.request.use(
        (config: any) => {
            const token = localStorage.getItem(tokenName);

            const newConfig = config;

            // When a 'token' is available set as Bearer token.
            if (token) {
                newConfig.headers.Authorization = `Bearer ${token}`;
            }

            return newConfig;
    },
    (err: any) => Promise.reject(err),
    );
};

const client = axios.create({
    baseURL: `${process.env.REACT_APP_API_DOMAIN}`,
    responseType: 'blob'
})

const getUrl = (props: any) => {
    const { basePath, page, perPage, filterValues } = props;
    const query = {
        page: page,
        perPage: perPage,
        type: 'pdf'
    }

    // Add all filter params to query.
    Object.keys(filterValues || {}).forEach((key: any) => {
        //@ts-ignore
        query[`filter[${key}]`] = filterValues[key];
    });

    return `${basePath.substring(1)}?${stringify(query)}`;
}

export const fileProvider = (props: any) => {
    const {
        apiUrl,
        tokenName,
        fileName,
        ...rest
    } = props;

    const url = getUrl(rest);

    const client = axios.create({
        baseURL: `${apiUrl}`,
        responseType: 'blob'
    })

    interceptors(client, `${tokenName}`);

    return ({
        getFile: async () => {
            const res = await client(url);

            const { data } = res

            if (!isEmpty(data)) {
                fileDownload(data, fileName);
            }
        }
    })
}
