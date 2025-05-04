// Initialize the calendar for date input
let calendar;
function showCustomDatePicker() {
  if (!calendar) {
    calendar = flatpickr("#customDateInput", {
      dateFormat: "d-m-Y",
      minDate: "today",
      enable: [
        function (date) {
          // return true to enable

          return date.getMonth() % 1 === 0 && date.getDate() < 32;
        },
      ],
      defaultDate: new Date(),
      onChange: function (selectedDates, dateStr, instance) {
        const dateParts = dateStr.split("-"); // Split the date by '-'
        const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // Reformat as YYYY-MM-DD
        document.getElementById("customDateInput").value = formattedDate;
        console.log("Reformatted Date picked:", formattedDate); // Log the reformatted date
      },
    });
  }
  calendar.open();
}
