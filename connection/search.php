<?php
include '../connection/db_connection.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 10; // number of records per page
$offset = ($page - 1) * $limit;

// Base query
$whereClause = '';
$params = [];
$types = '';

if ($search !== '') {
    $whereClause = "WHERE Other_Name LIKE ? OR Surname LIKE ? OR First_Name LIKE ?";
    $searchTerm = "%$search%";
    $params = [$searchTerm, $searchTerm, $searchTerm];
    $types = 'sss';
}

// Get total records count
$countSql = "SELECT COUNT(*) AS total FROM student_registration $whereClause";
$countStmt = $conn->prepare($countSql);
if ($whereClause !== '') {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);
$countStmt->close();

// Get paginated records
$dataSql = "SELECT * FROM student_registration $whereClause ORDER BY Id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare(
    $whereClause !== '' ?
    "$dataSql" :
    "SELECT * FROM student_registration ORDER BY Id DESC LIMIT ? OFFSET ?"
);

if ($whereClause !== '') {
    function refValues($arr)
    {
        $refs = [];
        foreach ($arr as $key => $value) {
            $refs[$key] = &$arr[$key]; // create reference
        }
        return $refs;
    }

    $bindTypes = $types . "ii";
    $bindValues = array_merge([$bindTypes], $params, [$limit, $offset]);
    call_user_func_array([$stmt, 'bind_param'], refValues($bindValues));

} else {
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

// Table rendering
echo "<table class='table table-bordered table-striped table-hover table-responsive'>";
echo "<thead><tr>
        <th>S/N</th>
        <th>Registration Number</th>
        <th>Surname</th>
        <th>First Name</th>
        <th>Other Name</th>
        <th>Gender</th>
        <th>Class</th>
        <th>Action</th>
      </tr></thead><tbody>";

$sn = $offset + 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$sn}</td>
            <td>{$row['Registration_Number']}</td>
            <td>{$row['Surname']}</td>
            <td>{$row['First_Name']}</td>
            <td>{$row['Other_Name']}</td>
            <td>{$row['Gender']}</td>
            <td>{$row['DOB']}</td>
            <td>
                <button class='btn btn-warning btn-sm'>Edit</button>
                <button class='btn btn-danger btn-sm'>Delete</button>
            </td>
        </tr>";
    $sn++;
}
echo "</tbody></table>";

// Pagination links
echo "<nav><ul class='pagination justify-content-center'>";
if ($page > 1) {
    echo "<li class='page-item'><a class='page-link' href='?search=$search&page=" . ($page - 1) . "'>Prev</a></li>";
}
for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='?search=$search&page=$i'>$i</a></li>";
}
if ($page < $totalPages) {
    echo "<li class='page-item'><a class='page-link' href='?search=$search&page=" . ($page + 1) . "'>Next</a></li>";
}
echo "</ul></nav>";

$conn->close();
?>