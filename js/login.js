

$(document).ready(function()
{
  $("#login-form").submit(function(event){
    event.preventDefault();

    // Get the values of the form fields
    var name = $("#name").val();
    var password = $("#password").val();

    // Make an AJAX call to the server
    $.ajax({
      type: "POST",
      url: "php/login.php",
      dataType: 'json',
      data: {
        name: name,
        password: password
      },
      success: function(response) {
        if (response.status == "success") {
          // Redirect the user to the success page
          window.location.href = "/success";
        } else {
          // Show an error message
          $("#error-message").html(response.message);
        }
      },
      error: function(xhr, status, error) {
        console.log("Error:", error);
      }
    });
  });
});