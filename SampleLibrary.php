<?php
// 1. DATABASE CREDENTIALS
//$host     = 'inepro.com';    // Change if your database is on a different server
$host     = '185.94.230.178'; // Change if your database is on a different server
$db       = 'manualsinepro_rfid-media-library';     // Your database name
$user     = 'manualsinepro_rfid-media-librarian';         // Your database username
$password = '#vNXPW@2slX4'; // Your database password
$charset  = 'utf8mb4'; 

// 2. SET UP THE PDO OPTIONS
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Turns errors into exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetches data as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Turns off emulation for real security
];

try {
    // 3. ESTABLISH THE CONNECTION
    $pdo = new PDO($dsn, $user, $password, $options);
    
    // 4. EXECUTE THE QUERY
    $stmt = $pdo->query('SELECT 
        SampleDBIndex,
        SampleIndex,
        SampleBitsNumber,
        SampleBitsTotal,
        SampleTechCode,
        SampleCommCode,
        SampleOutput,
        SampleHex,
        SampleFCS,
        SampleFormatNotes,
        SampleTypeID,
        SampleConfigName
        FROM Sample'
    );
    $records = $stmt->fetchAll();
            

} catch (\PDOException $e) {
    // If connection fails, stop the script and show the error
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #ff0000; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .no-data { text-align: center; color: #777; font-style: italic; }
    </style>
</head>
<body>

    <h1>All Database Records</h1>

    <table>
        <thead>
            <tr>
                <th>Index</th>
                <th>Bits Number</th>
                <th>Bits Total</th>
                <th>Tech Code</th>
                <th>Comm Code</th>
                <th>Output</th>
                <th>Hex</th>
                <th>FCS</th>
                <th>Format Notes</th>
                <th>Type ID</th>
                <th>Config Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)): ?>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <!-- htmlspecialchars prevents XSS attacks by sanitizing output -->
                        <td><?= htmlspecialchars($row['SampleIndex']) ?></td>
                        <td><?= htmlspecialchars($row['SampleBitsNumber']) ?></td>
                        <td><?= htmlspecialchars($row['SampleBitsTotal']) ?></td>
                        <td><?= htmlspecialchars($row['SampleTechCode']) ?></td>
                        <td><?= htmlspecialchars($row['SampleCommCode']) ?></td>
                        <td><?= htmlspecialchars($row['SampleOutput']) ?></td>
                        <td><?= htmlspecialchars($row['SampleHex']) ?></td>
                        <td><?= htmlspecialchars($row['SampleFCS']) ?></td>
                        <td><?= htmlspecialchars($row['SampleFormatNotes']) ?></td>
                        <td><?= htmlspecialchars($row['SampleTypeID']) ?></td>
                        <td><?= htmlspecialchars($row['SampleConfigName']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="15" class="no-data">No records found in the database.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
