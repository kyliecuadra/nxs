$(document).ready(function () {
    const form = $('.signin');
    const submitButton = form.find('button.next-step');
    const emailInput = $('#email');
    const passwordInput = $('#passwordInput');
    const confirmPasswordInput = $('#confirmPasswordInput');
    const emailValidation = $('#email_validation');
    const passwordHelp = $('#passwordHelp');
    const passwordMatchError = $('#passwordMatchError');

    // Clear error messages on page load
    emailValidation.text('');
    passwordHelp.text('');
    passwordMatchError.text('');

    // Function to check if all required fields are filled and meet validation criteria
    function checkFormFields() {
        const requiredInputs = form.find('input[required]');
        let allFieldsFilled = true;

        // Check each required input field
        requiredInputs.each(function () {
            if (!$(this).val().trim()) {
                allFieldsFilled = false;
                return false; // Exit the loop if any field is not filled
            }
        });

        // Email validation for @cvsu.edu.ph domain
        const email = emailInput.val().trim();
        const emailDomain = "@cvsu.edu.ph";
        if (!email.endsWith(emailDomain)) {
            emailValidation.text('Please use a valid @cvsu.edu.ph email address.');
            allFieldsFilled = false;
        } else {
            emailValidation.text('');
        }

        // Password validation
        const password = passwordInput.val();
        const confirmPassword = confirmPasswordInput.val();
        if (password !== confirmPassword) {
            passwordMatchError.text('Passwords do not match');
            allFieldsFilled = false;
        } else {
            passwordMatchError.text('');
        }

        if (password.length < 8 && password !== '') {
            passwordHelp.text('Password must be at least 8 characters long.');
            allFieldsFilled = false;
        } else {
            passwordHelp.text('');
        }

        return allFieldsFilled;
    }

    // Attach input event listeners to trigger the check when inputs change
    form.find('input').on('input', function() {
        const isValid = checkFormFields();
        submitButton.prop('disabled', !isValid);
    });

    // Check form fields on document ready
    const isValid = checkFormFields();
    submitButton.prop('disabled', !isValid);

    // Attach click event listener to the submit button
    submitButton.on('click', function (event) {
        // Check form fields before allowing form submission
        const isValid = checkFormFields();

        if (!isValid) {
            // Prevent the default click action if the form is not valid
            event.preventDefault();
        }
    });

    // Capitalize input text
    $('.capitalize').on('input', function() {
        let words = $(this).val().split(' ');
        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
        }
        $(this).val(words.join(' '));
    });
});
