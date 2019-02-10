import React from 'react';
import {Button} from 'react-materialize';

export default ({text, Icon, children, waves, ...rest}) =>
    <Button {...rest} waves={waves ? waves : 'light'}>{text}{Icon ?
        <Icon {...rest}>{text}</Icon> : {text}}</Button>;