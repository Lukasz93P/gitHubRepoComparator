import React from 'react';

export default ({fullName, authorName, name, url, avatarUrl}) => {
    const imageStyle ={
        maxHeight: '100px',
        maxWidth: '150px',
    };
    return (
        <div className="col-md-5 col-10 p-5 m-1">
            <div className="card row text-center justify-content-center">
                <img className="card-img-overlay rounded align-self-auto" src={avatarUrl} alt="Card image cap" style={imageStyle}/>
                <div className="card-body">
                    <h5 className="card-title">{fullName}</h5>
                    <h5>Author : {authorName}</h5>
                    <h5>Repository name : {name}</h5>
                    <a href={url} className="btn btn-primary">Go to repository</a>
                </div>
            </div>
        </div>)
}