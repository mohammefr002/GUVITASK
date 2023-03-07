// Selecting the login form and input fields
const loginForm = document.querySelector('.login-form');
const emailInput = document.querySelector('#name');
const passwordInput = document.querySelector('#password');

// Adding an event listener to the login form
loginForm.addEventListener('submit', (event) => {
  // Preventing the default form submission
  event.preventDefault();

  // Getting the values of the email and password inputs
  const emailValue = emailInput.value.trim();
  const passwordValue = passwordInput.value.trim();

  // Validating the email and password fields
  if (emailValue === '' || !isValidEmail(emailValue)) {
    // Displaying an error message for the email field
    emailInput.classList.add('error');
    emailInput.nextElementSibling.textContent = 'Please enter a valid email address.';
  } else if (passwordValue === '') {
    // Displaying an error message for the password field
    passwordInput.classList.add('error');
    passwordInput.nextElementSibling.textContent = 'Please enter your password.';
  } else {
    // Submitting the form if both fields are valid
    loginForm.submit();
  }
});

// Helper function to validate email addresses
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
