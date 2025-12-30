<?php
session_start();

// Database connection configuration
$dsn = "mysql:host=127.0.0.1;dbname=family_db;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Fetch families
    $stmt_families = $pdo->query("SELECT * FROM families ORDER BY family_id ASC");
    $families = $stmt_families->fetchAll();

    // Fetch persons with contacts
    $stmt = $pdo->query("SELECT p.person_id, p.first_name, p.last_name, p.gender, p.date_of_birth, p.date_of_death, p.place_of_birth, p.family_id, f.family_name, c.email, c.phone, c.contact_type FROM persons p LEFT JOIN families f ON p.family_id = f.family_id LEFT JOIN contacts c ON p.person_id = c.person_id ORDER BY p.person_id ASC, c.contact_type ASC");
    $results = $stmt->fetchAll();

    // Fetch addresses
    $stmt_addresses = $pdo->query("SELECT a.*, p.first_name, p.last_name FROM addresses a LEFT JOIN persons p ON a.person_id = p.person_id ORDER BY a.person_id ASC");
    $addresses = $stmt_addresses->fetchAll();

    // Fetch relationships
    $stmt_relationships = $pdo->query("SELECT r.*, p1.first_name as person1_first, p1.last_name as person1_last, p2.first_name as person2_first, p2.last_name as person2_last FROM relationships r LEFT JOIN persons p1 ON r.person_id_1 = p1.person_id LEFT JOIN persons p2 ON r.person_id_2 = p2.person_id ORDER BY r.person_id_1 ASC");
    $relationships = $stmt_relationships->fetchAll();

    if (empty($results) && empty($families) && empty($addresses) && empty($relationships)) {
        $message = "No data found in the database.";
    }

} catch (PDOException $e) {
    $_SESSION['message'] = "Database error: " . $e->getMessage();
    $results = [];
    $families = [];
    $addresses = [];
    $relationships = [];
}

// Close the database connection
$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database Records</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0;
            padding: 20px;
            background-color: #f4f7f6;
            color: #333;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        h1 { 
            color: #2c3e50; 
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        h2 {
            color: #34495e;
            margin-top: 30px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }
        .section {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #34495e;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .message { 
            color: #155724; 
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .error { 
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .back-link { 
            margin-top: 20px; 
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
        .empty-message {
            color: #6c757d;
            font-style: italic;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Family Database Records</h1>

        <?php
        if (isset($_SESSION['message'])) {
            $class = strpos($_SESSION['message'], 'Database error') === 0 ? 'error' : 'message';
            echo "<div class='$class'>" . htmlspecialchars($_SESSION['message']) . "</div>";
            unset($_SESSION['message']);
        } elseif (isset($message)) {
            echo "<div class='message'>" . htmlspecialchars($message) . "</div>";
        }
        ?>

        <!-- Families Section -->
        <?php if (!empty($families)): ?>
            <div class="section">
                <h2>Families</h2>
                <table>
                    <tr>
                        <th>Family ID</th>
                        <th>Family Name</th>
                        <th>Description</th>
                        <th>Created Date</th>
                    </tr>
                    <?php foreach ($families as $family): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($family['family_id']); ?></td>
                            <td><?php echo htmlspecialchars($family['family_name']); ?></td>
                            <td><?php echo htmlspecialchars($family['description'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($family['created_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>

        <!-- Persons and Contacts Section -->
        <?php if (!empty($results)): ?>
            <div class="section">
                <h2>Persons and Contact Information</h2>
                <table>
                    <tr>
                        <th>Person ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Date of Death</th>
                        <th>Place of Birth</th>
                        <th>Family</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Contact Type</th>
                    </tr>
                    <?php
                    $current_person_id = null;
                    foreach ($results as $row):
                        $is_new_person = $row['person_id'] !== $current_person_id;
                        $current_person_id = $row['person_id'];
                    ?>
                        <tr>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['person_id']) : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['first_name']) : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['last_name']) : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['gender'] ?? 'N/A') : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['date_of_birth'] ?? 'N/A') : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['date_of_death'] ?? 'N/A') : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['place_of_birth'] ?? 'N/A') : ''; ?></td>
                            <td><?php echo $is_new_person ? htmlspecialchars($row['family_name'] ?? 'N/A') : ''; ?></td>
                            <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['phone'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['contact_type'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php else: ?>
            <div class="section">
                <h2>Persons and Contact Information</h2>
                <div class="empty-message">No persons or contact information found.</div>
            </div>
        <?php endif; ?>

        <!-- Addresses Section -->
        <?php if (!empty($addresses)): ?>
            <div class="section">
                <h2>Addresses</h2>
                <table>
                    <tr>
                        <th>Address ID</th>
                        <th>Person</th>
                        <th>Street Address</th>
                        <th>City</th>
                        <th>State/County</th>
                        <th>Country</th>
                    </tr>
                    <?php foreach ($addresses as $address): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($address['address_id']); ?></td>
                            <td><?php echo htmlspecialchars(($address['first_name'] ?? '') . ' ' . ($address['last_name'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($address['street_address']); ?></td>
                            <td><?php echo htmlspecialchars($address['city'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($address['state_county'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($address['country'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>

        <!-- Relationships Section -->
        <?php if (!empty($relationships)): ?>
            <div class="section">
                <h2>Relationships</h2>
                <table>
                    <tr>
                        <th>Relationship ID</th>
                        <th>Person 1</th>
                        <th>Person 2</th>
                        <th>Relationship Type</th>
                    </tr>
                    <?php foreach ($relationships as $rel): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rel['relationship_id']); ?></td>
                            <td><?php echo htmlspecialchars(($rel['person1_first'] ?? '') . ' ' . ($rel['person1_last'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars(($rel['person2_first'] ?? '') . ' ' . ($rel['person2_last'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($rel['relationship_type']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>

        <a href="family.php" class="back-link">Back to Data Entry</a>
    </div>
</body>
</html>
