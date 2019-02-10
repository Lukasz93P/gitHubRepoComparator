export const required = (message = 'This field is required.') => value => value ? undefined : message;

export const minLength = (minLength, message = `This field should be at least ${minLength} long.`) => value =>
    value && value.length >= minLength ? undefined : message;

export const email = (message = 'This field should be a valid email address.') => value =>
    value && !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(value) ? message : undefined;

export const validateEmail = email();

export const validateRequired = required();

export const minLength2 = minLength(2);