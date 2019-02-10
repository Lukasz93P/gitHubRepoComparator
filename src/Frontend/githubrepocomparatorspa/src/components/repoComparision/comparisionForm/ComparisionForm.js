import React from 'react';
import {reduxForm} from 'redux-form';

import ComparisionFormFields from './FormFields';
import StandardForm from '../../shared/forms/StandardForm';
import {validateRequired} from "../../../helpers/validation/validators";

let ComparisionForm = props => <StandardForm {...props} FormFields={ComparisionFormFields}
                                             validateName={validateRequired}/>;

ComparisionForm = reduxForm({
    form: 'ComparisionForm',
    enableReinitialize: true,
})(ComparisionForm);

export default ComparisionForm