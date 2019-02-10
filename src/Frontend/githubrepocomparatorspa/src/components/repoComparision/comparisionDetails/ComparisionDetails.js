import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Redirect} from 'react-router-dom';

import NumericValuesComparisionCard from './cards/NumericValuesComparisionCard';
import StarIcon from '../../shared/icons/built/StarIcon';
import WatcherIcon from '../../shared/icons/built/WatcherIcon';
import SwapIcon from '../../shared/icons/built/SwapIcon';
import DatesComparisionCard from './cards/DatesComparisionCard';
import RepositoryCard from '../../repositories/RepositoryCard';
import StandardLoader from '../../shared/loaders/StandardLoader';
import Warnings from '../../shared/warnings/Warnings';

class ComparisionDetails extends Component {
    render = () => {
        const {
            comparedRepositories, starsComparision, forksComparision,
            watchersComparision, lastReleaseDateComparision
        } = this.props.comparision;

        const {error, loaded} = this.props;

        if (!loaded) {
            return (<StandardLoader size="big"/>)
        }
        if (error) {
            console.log('!!!!!!!!fsdfdsfdsfsdf!!!', error);
            return (<Warnings error={error}/>);
        }
        const firstComparedRepo = comparedRepositories[0];
        const secondComparedRepo = comparedRepositories[1];
        return (<div className="row justify-content-center min-vw-100 container">
            <div className="row justify-content-center align-items-start min-vw-100">
                <NumericValuesComparisionCard Icon={StarIcon} comparision={{
                    ...starsComparision,
                    firstRepositoryName: firstComparedRepo.fullName, secondRepositoryName: secondComparedRepo.fullName
                }} title="Stars comparision"/>
                <NumericValuesComparisionCard Icon={WatcherIcon} comparision={{
                    ...watchersComparision,
                    firstRepositoryName: firstComparedRepo.fullName, secondRepositoryName: secondComparedRepo.fullName
                }} title="Watchers comparision"/>
                <NumericValuesComparisionCard Icon={SwapIcon} comparision={{
                    ...forksComparision,
                    firstRepositoryName: firstComparedRepo.fullName, secondRepositoryName: secondComparedRepo.fullName
                }} title="Forks comparision"/>
                <DatesComparisionCard title="Last release date comparision" comparision={{
                    ...lastReleaseDateComparision,
                    firstRepositoryName: firstComparedRepo.fullName, secondRepositoryName: secondComparedRepo.fullName
                }}/>
            </div>
            <div className="row justify-content-center align-items-center min-vw-100">
                {comparedRepositories.map((repository, index) => {
                    return <RepositoryCard key={index} {...repository}/>;
                })}
            </div>
        </div>);
    }
}

function mapStateToProps(state) {
    return state.repoComparision;
}

export default connect(mapStateToProps)(ComparisionDetails)