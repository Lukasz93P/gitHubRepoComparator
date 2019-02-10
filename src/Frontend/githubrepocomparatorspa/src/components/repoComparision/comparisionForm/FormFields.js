import React from 'react';
import {Field} from "redux-form";
import Input from "../../shared/forms/inputs/StandardInput";

export default ({validateName, ...rest}) =>
    <div>
        <Field
            name="firstAuthor"
            type="text"
            label="First author name"
            className="form-control"
            component={Input}
            validate={validateName ? validateName : null}
        />
        <Field
            name="firstRepo"
            type="text"
            label="First repository name"
            className="form-control"
            component={Input}
            validate={validateName ? validateName : null}
        />
        <Field
            name="secondAuthor"
            type="text"
            label="Second author name"
            className="form-control"
            component={Input}
            validate={validateName ? validateName : null}
        />
        <Field
            name="secondRepo"
            type="text"
            label="Second repository name"
            className="form-control"
            component={Input}
            validate={validateName ? validateName : null}
        />
    </div>;