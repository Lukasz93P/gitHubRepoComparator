import React, {Component} from 'react';
import {Route, withRouter} from 'react-router-dom';
import {connect} from 'react-redux';

import ComparisionForm from './comparisionForm/ComparisionForm';
import ComparisionDetails from './comparisionDetails/ComparisionDetails';
import {compareRepositories} from '../../actions/repoComparisionActions/index';

class ComparatorMainPage extends Component {
    onComparisionFormSubmit = ({firstAuthor, firstRepo, secondAuthor, secondRepo}) => {
        const {dispatch, history} = this.props;
        dispatch(compareRepositories(firstAuthor, firstRepo, secondAuthor, secondRepo));
        history.push('/comparision/details');
    };

    render = () => {
        return (<div className="container row justify-content-center">
            <Route
                exact
                path="/comparision/details"
                component={ComparisionDetails}
            />
            <Route
                exact
                path="/comparision"
                render={() => {
                    return <ComparisionForm className="col-md-10 col-4" onFormSubmit={this.onComparisionFormSubmit}/>;
                }}
            />
        </div>)
    }
}

export default connect()(withRouter(ComparatorMainPage))