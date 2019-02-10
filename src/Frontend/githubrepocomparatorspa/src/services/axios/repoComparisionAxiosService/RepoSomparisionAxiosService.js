import axios from 'axios';

class RepoComparisionAxiosService {

    /**
     * @protected
     * @type {AxiosInstance}
     */
    service;

    constructor() {
        this.init();
    }

    init = () => {
        this.service = axios.create({
            baseURL: '/symfony/gitHubRepoComparator/web/app_dev.php/comparator/compare/',
            timeout: 99999999999999999,
        });
    };

    compareRepos = (firstAuthor, firstRepo, secondAuthor, secondRepo) => this.service.get([firstAuthor, firstRepo, secondAuthor, secondRepo].join('/'));
}

export default new RepoComparisionAxiosService();