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
        MediaIndex,
        MediumType,
        Printed1,
        Printed2,
        Printed3,
        Printed4,
        Printed5,
        Printed6,
        Brand,
        Color,
        Sample1,
        Sample2,
        Sample3,
        Sample4
        FROM Media'
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
                <th>MediaIndex</th>
                <th>MediumType</th>
                <th>Printed1</th>
                <th>Printed2</th>
                <th>Printed3</th>
                <th>Printed4</th>
                <th>Printed5</th>
                <th>Printed6</th>
                <th>Brand</th>
                <th>Color</th>
                <th>Sample1</th>
                <th>Sample2</th>
                <th>Sample3</th>
                <th>Sample4</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)): ?>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <!-- htmlspecialchars prevents XSS attacks by sanitizing output -->
                        <td><?= htmlspecialchars($row['MediaIndex']) ?></td>
                        <td><?= htmlspecialchars($row['MediumType']) ?></td>
                        <td><?= htmlspecialchars($row['Printed1']) ?></td>
                        <td><?= htmlspecialchars($row['Printed2']) ?></td>
                        <td><?= htmlspecialchars($row['Printed3']) ?></td>
                        <td><?= htmlspecialchars($row['Printed4']) ?></td>
                        <td><?= htmlspecialchars($row['Printed5']) ?></td>
                        <td><?= htmlspecialchars($row['Printed6']) ?></td>
                        <td><?= htmlspecialchars($row['Brand']) ?></td>
                        <td><?= htmlspecialchars($row['Color']) ?></td>
                        <td><?= htmlspecialchars($row['Sample1']) ?></td>
                        <td><?= htmlspecialchars($row['Sample2']) ?></td>
                        <td><?= htmlspecialchars($row['Sample3']) ?></td>
                        <td><?= htmlspecialchars($row['Sample4']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-data">No records found in the database.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
