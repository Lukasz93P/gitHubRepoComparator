import React, {Component} from 'react';
import {Redirect, Route} from 'react-router-dom';

import ComparisionMainPage from './components/repoComparision/ComparatorMainPage';

class App extends Component {
    render() {
        return (
            <div className="App m-auto row justify-content-center">
                <Route
                    exact
                    path="/"
                    render={() => {
                        return <Redirect to="/comparision"/>;
                    }}
                />
                <Route
                    path="/comparision"
                    component={ComparisionMainPage}
                />
            </div>
        );
    }
}

export default App;
