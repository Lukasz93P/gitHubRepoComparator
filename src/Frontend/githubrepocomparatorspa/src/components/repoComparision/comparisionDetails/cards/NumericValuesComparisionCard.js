import React from 'react';
import {Card} from 'react-materialize';
import {PieChart, Legend} from 'react-easy-chart';

export default ({Icon, title, comparision, ...rest}) => {
    const {first, second, firstRepositoryName, secondRepositoryName} = comparision;
    const chartData = [{key: firstRepositoryName, value: first.quantity}, {
        key: secondRepositoryName, value: second.quantity
    }];

    return (<div className="col-10 col-md-3 text-center">
        <Card {...rest}>
            <Icon medium/>
            <p className="h-6">{title}</p>
            <div>
                <PieChart data={chartData} size={300}/>

                <Legend data={chartData} dataId={'key'}/>
            </div>
        </Card>
    </div>)
}