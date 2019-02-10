import * as redux from 'redux';
import logger from 'redux-logger';
import thunk from 'redux-thunk';

import {reducer as formReducer} from 'redux-form';

import {repoComparisionReducer} from "./repoComparision/repoComparisionReducers";

export default () => {
    const combinedReducer = redux.combineReducers({form: formReducer, repoComparision: repoComparisionReducer});

    return redux.createStore(combinedReducer, redux.applyMiddleware(logger, thunk));
}