import axios from 'axios';

import {COMPARATOR_API_URL} from "../../../config";

class RepoComparisionAxiosService {

    service;

    constructor() {
        this.init();
    }

    init = () => {
        this.service = axios.create({
            baseURL: COMPARATOR_API_URL,
            timeout: 99999999999999999,
        });
    };

    compareRepos = (firstAuthor, firstRepo, secondAuthor, secondRepo) => this.service.get([firstAuthor, firstRepo, secondAuthor, secondRepo].join('/'));
}

export default new RepoComparisionAxiosService();