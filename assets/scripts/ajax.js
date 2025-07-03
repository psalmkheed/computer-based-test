$(document).ready(function () {
  // Handle form submission for adding exams
  $("#addExamForm").on("submit", (e) => {
    e.preventDefault(); // Prevent the default form submission

    // Get form data
    var formData = $(e.target).serialize();

    // Send an AJAX request to add the exam
    $.ajax({
      url: "/connection/db_connection.php",
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle success response
        alert("Exam added successfully!");
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle error response
        alert("Error adding exam: " + error);
      },
    });
  });

  // Handle delete exam button click
  $(document).on("click", ".delete-exam-btn", function (e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to delete this exam?")) return;

    const button = $(this);
    const examId = button.data("id");

    $.ajax({
      url: "/CBT/connection/delete_exam.php",
      type: "POST",
      data: {
        exam_id: examId,
      },
      success: function (response) {
        alert(response);
        button.closest("tr").fadeOut(); // Remove row on success
      },
      error: function (xhr) {
        console.error("Error:", xhr.responseText); // Log the server response
        alert("An error occurred while deleting the exam: " + xhr.responseText);
      },
    });
  });
});
