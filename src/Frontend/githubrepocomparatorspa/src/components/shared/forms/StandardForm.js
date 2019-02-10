import React from 'react';
import ConfirmationButton from "../buttons/built/ConfirmationButton";

export default props => {
    const {
        onFormSubmit,
        valid,
        handleSubmit,
        pristine,
        reset,
        submitting,
        FormFields,
        ...rest
    } = props;
    return (<form onSubmit={handleSubmit(onFormSubmit)} className="form-group m-3 p-3 text-center">
        <FormFields {...rest}/>
        <ConfirmationButton
            type="submit"
            disabled={!valid || pristine || submitting}
            text="Submit"
        />
    </form>);
}