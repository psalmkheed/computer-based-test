$(document).ready(function () {
  // Handle form submission
  $("#addExamForm").on("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Get form data
    var formData = $(this).serialize();

    // Send an AJAX request to add the exam
    $.ajax({
      url: "add_exam.php",
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle success response
        alert("Exam added successfully!");
        window.location.href = "admin.php#viewExam"; // Redirect to the view exam page
      },
      error: function (xhr, status, error) {
        // Handle error response
        alert("Error adding exam: " + error);
      },
    });
  });
});

$(document).ready(function () {
  $(".delete-exam-btn").on("click", function (e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to delete this exam?")) return;

    const button = $(this);
    const examId = button.data("id");

    $.ajax({
      url: "delete_exam.php",
      type: "POST",
      data: {
        delete_exam: true,
        exam_id: examId,
      },
      success: function (response) {
        alert(response);
        button.closest("tr").fadeOut(); // remove row on success
      },
      error: function () {
        alert("An error occurred while deleting the exam.");
      },
    });
  });
});
