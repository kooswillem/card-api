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
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// 2. Fetch Route Parameter (e.g., view.php?id=10942)
$parentId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$parentId) {
    die("Invalid or missing Record ID.");
}

// 3. Query Parent Record
$parentStmt = $pdo->prepare("SELECT * FROM Media WHERE id = ?");
$parentStmt->execute([$parentId]);
$parent = $parentStmt->fetch();

if (!$parent) {
    die("Parent record not found.");
}

// 4. Query Subrecords (Loaded all at once)
$subStmt = $pdo->prepare("SELECT * FROM Sample WHERE SampleParentID = ? ORDER BY SampleIndex DESC");
$subStmt->execute([$parentId]);
$subrecords = $subStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record - <?= htmlspecialchars($parent['name']) ?></title>
<!--
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #ff0000; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .no-data { text-align: center; color: #777; font-style: italic; }
    </style>
-->
    <script src="https://tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 p-6">

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Parent Record Header -->
        <header class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-blue-600">Parent Record</span>
                <h1 class="text-2xl font-bold text-gray-900">
                    <?= htmlspecialchars($parent['name']) ?> (ID: #<?= htmlspecialchars($parent['id']) ?>)
                </h1>
            </div>
            <a href="edit.php?id=<?= $parent['id'] ?>" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                Edit Record
            </a>
        </header>

        <!-- Parent Record Details -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div>
                <span class="block text-xs font-medium text-gray-500 uppercase">Primary Contact</span>
                <span class="mt-1 block text-sm font-semibold text-gray-800">
                    <?= htmlspecialchars($parent['contact_name'] ?? 'N/A') ?>
                </span>
            </div>
            <div>
                <span class="block text-xs font-medium text-gray-500 uppercase">Email Address</span>
                <span class="mt-1 block text-sm font-semibold text-gray-800">
                    <?= htmlspecialchars($parent['email'] ?? 'N/A') ?>
                </span>
            </div>
            <div>
                <span class="block text-xs font-medium text-gray-500 uppercase">Account Status</span>
                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <?= htmlspecialchars($parent['status'] ?? 'Active') ?>
                </span>
            </div>
        </section>

        <!-- Subrecords Loop Section -->
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Linked Subrecords (Orders)</h2>
                <span class="text-xs bg-gray-200 text-gray-700 px-2.5 py-1 rounded-full font-semibold">
                    <?= count($subrecords) ?> Total
                </span>
            </div>

            <div class="space-y-3">
                <?php if (empty($subrecords)): ?>
                    <p class="text-sm text-gray-500 italic p-4 bg-white rounded-lg border border-gray-200">No subrecords linked to this profile.</p>
                <?php else: ?>
                    <?php foreach ($subrecords as $index => $row): ?>
                        <?php $uniqueId = "sub-" . $row['id']; ?>
                        
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <!-- Toggle Header Trigger -->
                            <button onclick="toggleSubrecord('<?= $uniqueId ?>')" class="w-full flex items-center justify-between p-4 hover:bg-gray-50 text-left transition">
                                <div class="flex items-center space-x-4">
                                    <span class="font-mono text-sm font-bold text-gray-600">#<?= htmlspecialchars($row['order_number']) ?></span>
                                    <span class="text-sm text-gray-800 font-medium"><?= htmlspecialchars($row['item_summary']) ?></span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm font-semibold text-gray-900">$<?= number_format($row['amount'], 2) ?></span>
                                    <svg id="icon-<?= $uniqueId ?>" class="w-5 h-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </button>
                            
                            <!-- Expandable Subrecord Metadata -->
                            <div id="<?= $uniqueId ?>" class="hidden border-t border-gray-100 bg-gray-50 p-4 text-sm text-gray-600 grid grid-cols-2 gap-4">
                                <div><strong class="text-gray-700">Order Date:</strong> <?= htmlspecialchars($row['order_date']) ?></div>
                                <div><strong class="text-gray-700">Fulfillment:</strong> <?= htmlspecialchars($row['fulfillment_status']) ?></div>
                                <div class="col-span-2"><strong class="text-gray-700">Notes:</strong> <?= htmlspecialchars($row['notes'] ?? 'None') ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <!-- JavaScript Interactive UI Logic -->
    <script>
        function toggleSubrecord(id) {
            const detailsPanel = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            
            if (detailsPanel.classList.contains('hidden')) {
                detailsPanel.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                detailsPanel.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
</body>
</html>
