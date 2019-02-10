import {COMPARE_REPOS_INIT, COMPARE_REPOS_SUCCESS, COMPARE_REPOS_FAILURE} from "./repoComparisionActionTypes";

import AxiosRepoComparisionService from '../../services/axios/repoComparisionAxiosService/RepoSomparisionAxiosService';

export const compareRepositories = (firstAuthor, firstRepo, secondAuthor, secondRepo) => {
    return async dispatch => {
        dispatch(compareReposInit());
        try {
            const response = await AxiosRepoComparisionService.compareRepos(firstAuthor, firstRepo, secondAuthor, secondRepo);
            dispatch(compareReposSuccess(response.data));
        }
        catch (error) {
            dispatch(compareReposFailure(error));
        }
    }
};

const compareReposInit = () => {
    return {
        type: COMPARE_REPOS_INIT,
    }
};

const compareReposSuccess = data => {
    return {
        type: COMPARE_REPOS_SUCCESS,
        payload: data,
    }
};

const compareReposFailure = error => {
    return {
        type: COMPARE_REPOS_FAILURE,
        payload: error.response.data,
    }
};