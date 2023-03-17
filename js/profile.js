
$(document).ready(function(){
  $("#profile-form").submit(function(event){
    event.preventDefault();

    // Get the values of the form fields
    var Name = $("#Name").val();
    var email = $("#email").val();
    var age = $("#age").val();
    var dob = $("#dob").val();
    var contact = $("#contact").val();

    // Make an AJAX call to the server
    $.ajax({
      type: "POST",
      url: "php/profile.php",
      dataType: 'json',
      data: {
        Name: Name,
        email: email,
        age: age,
        contact: contact
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