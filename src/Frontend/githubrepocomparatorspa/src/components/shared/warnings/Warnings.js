import React from 'react';

export default ({error}) =>
    <div className='alert alert-warning row justify-content-md-center'>
        <h2>{error.message}</h2>
    </div>;