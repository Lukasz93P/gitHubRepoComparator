import React from 'react';
import {Card} from 'react-materialize';

import DateIcon from '../../../shared/icons/built/DateIcon';

export default ({Icon, title, comparision, ...rest}) => {
    const {newer, diff, firstRepositoryName, secondRepositoryName} = comparision;
    const newerRepoName = newer === 'tie' ? newer : (newer === firstRepositoryName ? firstRepositoryName : secondRepositoryName);
    return (<div className="col-10 col-md-3 text-center">
        <Card {...rest}>
            <DateIcon medium/>
            <p className="h-6">{title}</p>
            <h5>Newer : {newerRepoName}</h5>
            {diff ? <h5>Days difference between releases : {diff}</h5> : ''}
        </Card>
    </div>)
}