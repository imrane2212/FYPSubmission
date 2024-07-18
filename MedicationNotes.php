<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication Notes</title>
    <link rel="stylesheet" href="Spatient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_k2111451";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT medication, side_effects FROM medication_notes";
$result = $conn->query($sql);
?>

    <div class="sidebar">
        <button><i class="fas fa-capsules"></i> Upcoming Medication</button>
        <button><i class="fas fa-book-medical"></i> Medication History</button>
        <button><i class="fas fa-bell"></i> Medication Reminders</button>
        <button><i class="fas fa-notes-medical"></i> Medication Notes</button>
        <div class="sidebar-bottom">
            <button><i class="fas fa-cog"></i> Settings</button>
            <button onclick="window.location.href='Login.php'"><i class="fas fa-sign-out-alt"></i> Log out</button>
        </div>
    </div>

    <div class="main-content">
        <h2 class="patient-heading">Medication Notes</h2>
        <table class="patient-list">
            <thead>
                <tr>
                    <th>Medication</th>
                    <th>Side Effects</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["medication"]) ?></td>
                            <td><?= htmlspecialchars($row["side_effects"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="2">No medication notes found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="button-container" style="text-align: center; margin-top: 20px;">
            <button onclick="window.location.href='PatientOverview.php'" class="button-back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <button onclick="window.location.href='AddMedNotes.php'" class="button">
                <i class="fas fa-plus"></i> Add Medication Notes
            </button>
        </div>
    </div>

<?php
$conn->close();
?>

</body>
</html>