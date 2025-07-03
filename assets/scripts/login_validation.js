function validateForm() {
  var username = document.getElementById("username").value.trim();
  var password = document.getElementById("password").value.trim();
  var messageDiv = document.getElementById("messageBox");

  const showMessage = (message, type) => {
    messageDiv.innerHTML = message;
    messageDiv.style.display = "block";
    messageDiv.style.opacity = 1;
    messageDiv.style.transition = "opacity 0.5s ease";

    if (type === "error") {
      messageDiv.className =
        "alert bg-danger text-center text-white mt-3 shake";
    } else if (type === "success") {
      messageDiv.className = "alert bg-success text-center text-white mt-3";
    }

    // Scroll to message
    messageDiv.scrollIntoView({ behavior: "smooth", block: "center" });

    // Remove shake effect after 1s
    if (type === "error") {
      setTimeout(() => {
        messageDiv.classList.remove("shake");
      }, 1000);
    }

    // Auto-hide after 3 seconds
    setTimeout(() => {
      messageDiv.style.opacity = 0;
      setTimeout(() => {
        messageDiv.style.display = "none";
      }, 500);
    }, 3000);
  }

  if (username === "") {
    showMessage("Please enter a valid admission number.", "error");
    return false;
  } else if (password === "") {
    showMessage("Please enter your password.", "error");
    return false;
  } else {
    showMessage("Login successful! Redirecting...", "success");
    return true;
  }
}

$("#login_Form").on("submit", function (e) {
  e.preventDefault();

  if (!validateForm()) return;
  $("#errorText").fadeOut();

  var formData = $(this).serialize();
  var $btn = $("#loginBtn");
  $btn
    .prop("disabled", true)
    .append(
      '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>'
    );

  $.ajax({
    url: "/CBT/connection/user_login.php",
    type: "POST",
    data: formData,
    success: function (response) {
      response = response.trim();
      if (response === "admin") {
        window.location.href = "/CBT/admin.php";
      } else if (response === "teacher") {
        window.location.href = "/CBT/teacher.php";
      } else if (response === "student") {
        window.location.href = "/CBT/student.php";
      } else {
        document.getElementById("errorText").innerHTML = response;
        $btn.prop("disabled", false).text("Login"); // Re-enable on error
      }
    },
    error: function (xhr, status, error) {
      alert("Error logging in: " + error);
      $btn.prop("disabled", false).text("Login"); // Re-enable on error
    },
  });
});
