// Selecting the form and input fields
const form = document.querySelector('form');
const nameInput = document.querySelector('input[name="name"]');
const emailInput = document.querySelector('input[name="email"]');
const ageInput = document.querySelector('input[name="age"]');
const dobInput = document.querySelector('input[name="dob"]');
const contactInput = document.querySelector('input[name="contact"]');

// Adding an event listener to the form submission
form.addEventListener('submit', (event) => {
  // Preventing the default form submission
  event.preventDefault();

  // Getting the values of the input fields
  const nameValue = nameInput.value.trim();
  const emailValue = emailInput.value.trim();
  const ageValue = ageInput.value.trim();
  const dobValue = dobInput.value.trim();
  const contactValue = contactInput.value.trim();

  // Validating the input fields
  if (nameValue === '') {
    // Displaying an error message for the name field
    nameInput.classList.add('error');
    nameInput.nextElementSibling.textContent = 'Please enter your name.';
  } else if (emailValue === '' || !isValidEmail(emailValue)) {
    // Displaying an error message for the email field
    emailInput.classList.add('error');
    emailInput.nextElementSibling.textContent = 'Please enter a valid email address.';
  } else if (ageValue === '' || ageValue < 1 || ageValue > 150) {
    // Displaying an error message for the age field
    ageInput.classList.add('error');
    ageInput.nextElementSibling.textContent = 'Please enter a valid age between 1 and 150.';
  } else if (dobValue === '') {
    // Displaying an error message for the date of birth field
    dobInput.classList.add('error');
    dobInput.nextElementSibling.textContent = 'Please enter your date of birth.';
  } else if (contactValue === '') {
    // Displaying an error message for the contact field
    contactInput.classList.add('error');
    contactInput.nextElementSibling.textContent = 'Please enter your contact information.';
  } else {
    // Submitting the form if all fields are valid
    form.submit();
  }
});

// Helper function to validate email addresses
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
