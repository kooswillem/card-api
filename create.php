<?php
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
        $pdo->query("DROP TABLE IF EXISTS Media");
        $pdo->query("CREATE TABLE Media (
            MediaDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            MediaIndex INT NOT NULL,
            MediumType VARCHAR(255) NOT NULL,
            PrimarySample int NOT NULL,
            CISCode VARCHAR(255) NOT NULL,
            Printed1 VARCHAR(255),
            Printed2 VARCHAR(255),
            Printed3 VARCHAR(255),
            Printed4 VARCHAR(255),
            Printed5 VARCHAR(255),
            Printed6 VARCHAR(255),
            Printed7 VARCHAR(255),
            Brand VARCHAR(255),
            Color VARCHAR(255),
            Sample1 int NOT NULL,
            Sample2 int,
            Sample3 int,
            Sample4 int
        )");
        // 4. EXECUTE THE QUERY
        $pdo->exec("INSERT INTO Media (
            MediaIndex,
            MediumType,
            PrimarySample,
            CISCode,
            Printed1,
            Printed2,
            Printed3,
            Printed4,
            Printed5, 
            Printed6, 
            Printed7, 
            Brand, 
            Color, 
            Sample1, 
            Sample2, 
            Sample3, 
            Sample4) VALUES (
            1, 
            'Thin Card', 
            1, 
            '01-15',
            '808659546', 
            'www.cardtech.no', 
            '50010/M2750', 
            'HF01.01', 
            '', 
            '', 
            '', 
            '',
            '', 
            1, 
            NULL, 
            NULL, 
            NULL
        )");


    } catch (\PDOException $e) {
    // If connection fails, stop the script and show the error
    die("Database connection failed: " . $e->getMessage());
}
?>