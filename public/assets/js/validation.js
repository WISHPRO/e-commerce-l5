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

    var formFields = {
        login: {
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
            }
        },
        registration: {
            fields: {
                first_name: {
                    validMessage: 'That name looks great',
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
                    validMessage: 'That name looks great',
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
                            message: 'Please enter your phone number'
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
                },
                email: {
                    validMessage: 'That email address looks great',
                    validators: {
                        notEmpty: {
                            message: 'Please enter your email address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid email address'
                        }
                    }
                },
                ///^[a-zA-Z0-9]+$/
                password: {
                    validMessage: 'That password is ok',
                    validators: {
                        notEmpty: {
                            message: 'Please enter your password'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The password should be between 6 and 30 characters'
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
                accept: {
                    validators: {
                        choice: {
                            min: 1,
                            message: 'Please accept the terms of agreement'
                        }
                    }
                }
            }
        },
        'reset1': {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your email address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid email address'
                    }
                }
            }
        }

    };


    doValidate($('#loginForm'), formFields.login);
    doValidate($('#registrationForm'), formFields.registration);
    doValidate($('#resetAccount1'), formFields.reset1);

    //var id = $('#registrationForm');
    //console.log(id);
    //doValidate(id, formFields.registration);

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