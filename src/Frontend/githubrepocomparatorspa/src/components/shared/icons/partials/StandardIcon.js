import React from 'react';
import {Icon} from 'react-materialize';

export default ({iconType, ...rest}) => <Icon {...rest}>{iconType}</Icon>;
