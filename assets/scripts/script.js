$(document).ready(() => {
  // Load the default page when the brand logo is clicked
  $("#brand").on("click", () => {
    window.location.href = "admin.php";
  });

  // $("#mainContentTeacher").load("teacher/set_exam.php");
  $("#brandTeacher").on("click", () => {
    window.location.href = "teacher.php";
  });
  $("#manageStudent").on("click", () => {
    $("#mainContent").load("pages/admin_manageStudent.php");
  });
  $("#addStaff").on("click", () => {
    $("#mainContent").load("pages/admin_addStaff.php");
  });
  $("#subject").on("click", () => {
    $("#mainContent").load("pages/admin_subject.php");
  });
  $("#addExam").on("click", () => {
    $("#mainContent").load("pages/admin_addExam.php");
  });
  // This is for the teacher's page
  $("#addExamT").on("click", () => {
    $("#mainContentTeacher").load("pages/admin_viewExam.php");
  });
  $("#viewExam").on("click", () => {
    $("#mainContent").load("pages/admin_viewExam.php");
  });

  $("#startExam").on("click", () => {
    $("#mainContentStudent").load("student/exams.php");
  });

  $("#next").on("click", () => {
    $("#mainContentStudent").load(
      "student/start_exam.php?exam_id=<?= urlencode($exam['exam_id']) ?>"
    );
  });
});
