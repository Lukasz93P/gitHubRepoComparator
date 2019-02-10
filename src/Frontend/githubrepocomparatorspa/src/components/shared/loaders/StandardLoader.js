import React from 'react';
import {Row, Preloader} from 'react-materialize';

export default props =>
    <Row className="p-5 m-5 row justify-content-center">
        <h1 className="d-3 p-5 m-5 d-inline-block position-relative">{props.text ? props.text : 'Please wait'}</h1>
        <Preloader {...props}/>
    </Row>