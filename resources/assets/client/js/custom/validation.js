/**
 * Created by Antony on 1/17/2015.
 */

(function ($) {
    // still trying to reuse validation logic...need help

    var icons = {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    };

    var reusableFields = {
        email: {
            validators: {
                notEmpty: {
                    message: 'Please enter your email address'
                },
                emailAddress: {
                    message: 'Please enter a valid email address'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Please enter your password'
                }
            }
        },
        password_confirmation: {
            validMessage: 'Good. The passwords match',
            validators: {
                notEmpty: {
                    message: 'Please repeat your password'
                },
                identical: {
                    field: 'password',
                    message: 'The passwords do not match'
                }
            }
        },
        comment: {
            notEmpty: {
                message: 'Please enter your first comment'
            },
            stringLength: {
                min: 3,
                max: 500,
                message: 'your comment must be between 3 and 500 characters'
            }
        },
        stars: {
            notEmpty: {
                message: 'Please pick a star rating'
            }
        }
    };

    var formFields = {
        // login
        login: {
            email: reusableFields.email,
            password: reusableFields.password
        },

        // user registration
        registration: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your first name'
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: 'The name must be between 3 and 20 characters'
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The name can consist of alphabetical characters and spaces only'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your last/second name'
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: 'The name must be between 3 and 20 characters'
                        },
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The second name can consist of alphabetical characters and spaces only'
                        }
                    }
                }, phone: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your phone number e.g 7123456789'
                        },
                        digits: {
                            min: 1,
                            max: 9,
                            message: 'Your phone number should consist of 9 digits'
                        }
                    }
                },
                email: reusableFields.email,
                password: reusableFields.password,
                password_confirmation: reusableFields.password_confirmation,

                accept: {
                    validators: {
                        choice: {
                            min: 1,
                            message: 'Please accept the terms of agreement'
                        }
                    }
                }
        },

        // requesting to reset a password
        "forgot": {
            email: reusableFields.email
        },

        'resetPassword' : {
            email: reusableFields.email,
            password: reusableFields.password,
            password_confirmation: reusableFields.password_confirmation

        },

        'reviews': {
            comment : reusableFields.comment,
            stars: reusableFields.stars
        }

    };


    doValidate($('#loginForm'), formFields.login);

    doValidate($('#registrationForm'), formFields.registration);

    doValidate($('#resetPasswordForm'), formFields.resetPassword);

    doValidate($('#forgotPassword'), formFields.forgot);

    doValidate($('#reviewsForm'), formFields.reviews);

    // the form validation function
    function doValidate(formID, formObject) {
        formID.formValidation({
            framework: 'bootstrap',
            icon: {
                valid: icons.valid,
                invalid: icons.invalid,
                validating: icons.validating
            },
            fields: formObject
        });
    }

})(jQuery);