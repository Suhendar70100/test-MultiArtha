'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          // Name field validation
          name: {
            validators: {
              notEmpty: {
                message: 'Please enter your name'
              }
            }
          },
          // Email field validation
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter your email'
              },
              emailAddress: {
                message: 'Please enter a valid email address'
              }
            }
          },
          // Password field validation
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          // Confirm Password field validation
          password_confirmation: {
            validators: {
              notEmpty: {
                message: 'Please confirm your password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirmation do not match'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          // Address field validation
          address: {
            validators: {
              notEmpty: {
                message: 'Please enter your address'
              }
            }
          },
          // Phone Number field validation
          phone_number: {
            validators: {
              notEmpty: {
                message: 'Please enter your phone number'
              },
              digits: {
                message: 'Please enter a valid phone number'
              }
            }
          },
          // Driver's License Number field validation
          driver_license_number: {
            validators: {
              notEmpty: {
                message: 'Please enter your driver\'s license number'
              },
              digits: {
                message: 'Driver\'s license number must contain only digits'
              }
            }
          },
          // Terms and Conditions validation
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree to the terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    // Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();

  // Toggle password visibility
  document.getElementById('toggle-password').addEventListener('click', function() {
    let passwordField = document.getElementById('password');
    let toggleIcon = document.getElementById('toggle-icon');
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('mdi-eye-off-outline');
      toggleIcon.classList.add('mdi-eye-outline');
    } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('mdi-eye-outline');
      toggleIcon.classList.add('mdi-eye-off-outline');
    }
  });
});
