import getQueryFromParams from '../utils/getQueryFromParams'
import fileDownload from 'js-file-download';
import axios from '../api/binary'

const download = (url, params, filename, title = null) => {
    axios({
        method: 'GET',
        url: url,
        params: {
            ...getQueryFromParams(params),
            title: title
        }
    }).then(res => {
        fileDownload(res.data, filename);
    });
}

export default download
