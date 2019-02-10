import axios from 'axios';

class RepoComparisionAxiosService {

    /**
     * @protected
     * @type {AxiosInstance}
     */
    service;

    /**
     * @private
     * @param {object} config
     */
    init = config => {
        this.service = axios.create(config);
    };
}