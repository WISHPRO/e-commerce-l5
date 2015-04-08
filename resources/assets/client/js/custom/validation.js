/*
 * Sitewide Form validation
 *
 * */
(function ($) {

    var icons = {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    };

    var commonFields = {
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
                },
                stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Your password must be between 6 and 30 characters'
                }
            }
        },
        loginPassword: {
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
                message: 'Please enter your comment'
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
        },
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
        },
        phone: {
            validators: {
                notEmpty: {
                    message: 'Please enter your phone number e.g 7123456789'
                },
                stringLength: {
                    min: 9,
                    max: 9,
                    message: 'Your phone number should consist of 9 digits'
                },
                numeric: {
                    lessThan: 9,
                    message: 'That is not a valid number'
                }
            }
        },
        town: {
            validators: {
                notEmpty: {
                    message: 'Please enter your hometown'
                },
                stringLength: {
                    min: 3,
                    max: 30,
                    message: 'The town name must be between 3 and 30 characters'
                },
                regexp: {
                    regexp: /^[a-z\s]+$/i,
                    message: 'The town name can consist of alphabetical characters and spaces only'
                }
            }
        },
        home_address: {
            validators: {
                notEmpty: {
                    message: 'Please enter your home address'
                },
                stringLength: {
                    min: 3,
                    max: 100,
                    message: 'The home address must be between 3 and 100 characters'
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

    };

    var forms = {
        // login
        login: {
            email: commonFields.email,
            password: commonFields.loginPassword
        },

        // user registration
        registration: {
            first_name: commonFields.first_name,
            last_name: commonFields.last_name,
            phone: commonFields.phone,
            town: commonFields.town,
            email: commonFields.email,
            home_address: commonFields.home_address,
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation,
            accept: commonFields.accept
        },

        // requesting to reset a password
        forgot: {
            email: commonFields.email
        },

        // resetting a password
        resetPassword: {
            email: commonFields.email,
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation

        },

        // commenting on a product
        reviews: {
            comment: commonFields.comment,
            stars: commonFields.stars
        },

        // emailing a product
        emailProduct: {
            email: commonFields.email,
            comment: commonFields.comment
        },

        // checking out as a guest
        guestCheckout: {
            first_name: commonFields.first_name,
            last_name: commonFields.last_name,
            town: commonFields.town,
            home_address: commonFields.home_address,
            phone: commonFields.phone,
            email: commonFields.email

        },

        // editing the password, in the user profile section
        accountPasswordEdit: {
            password: commonFields.password,
            password_confirmation: commonFields.password_confirmation
        },

        // editing user contact information in their profile section
        contactInfoEdit: {
            phone: commonFields.phone,
            email: commonFields.email
        }

    };


    //doValidate($('#loginForm'), forms.login);

    doValidate($('#registrationForm'), forms.registration);

    doValidate($('#resetPasswordForm'), forms.resetPassword);

    //doValidate($('#forgotPassword'), forms.forgot);

    //doValidate($('#reviewsForm'), forms.reviews);

    doValidate($('#productMailForm'), forms.emailProduct);

    doValidate($('#guestCheckoutForm'), forms.guestCheckout);

    //doValidate($('#simplePasswordResetForm'), forms.accountPasswordEdit);

    // doValidate($('#editContactInfo'), forms.contactInfoEdit);

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