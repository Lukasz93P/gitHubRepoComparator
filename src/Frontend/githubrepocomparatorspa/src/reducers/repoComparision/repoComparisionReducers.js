import {
    COMPARE_REPOS_INIT,
    COMPARE_REPOS_SUCCESS,
    COMPARE_REPOS_FAILURE
} from "../../actions/repoComparisionActions/repoComparisionActionTypes";

const initialState = {
    loaded: false,
    comparision: {},
    error: false,
};

export const repoComparisionReducer = (state = initialState, action) => {
    switch (action.type) {
        case COMPARE_REPOS_INIT: {
            return {...state, loaded: false, comparision: {}, error: false};
        }
        case COMPARE_REPOS_SUCCESS : {
            return {...state, loaded: true, comparision: action.payload, error: false}
        }
        case COMPARE_REPOS_FAILURE : {
            return {...state, loaded: true, comparision: {}, error: action.payload}
        }
        default : {
            return state;
        }
    }
};