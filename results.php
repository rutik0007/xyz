<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'online_voting');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Query to count the number of votes for each candidate
$query = 'SELECT candidate, COUNT(*) AS vote_count FROM votes GROUP BY candidate ORDER BY vote_count DESC';
$result = $conn->query($query);

// Initialize vote counts for 4 candidates (Simulated example)
$votes = array(0, 0, 0, 0); // Array to store votes for 4 candidates

// Simulate some votes (you can use any logic to simulate votes)
$votes[0]++; // Vote for candidate 1
$votes[2]++; // Vote for candidate 3
$votes[0]++; // Vote for candidate 1

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        table, th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #007BFF; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Election Results</h1>
    
    <h2>Votes from Database:</h2>
    <table>
        <thead>
            <tr>
                <th>Candidate Name</th>
                <th>Votes</th>
            </tr>
        </thead>
        <tbody>
<?php
// Display the results from the database
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['candidate']) . '</td>';
        echo '<td>' . htmlspecialchars($row['vote_count']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="2">No votes found.</td></tr>';
}
?>
        </tbody>
    </table>

    
    <?php
    $conn->close();
    ?>
</body>
</html>
