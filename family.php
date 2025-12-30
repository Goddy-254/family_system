<?php
session_start();
$persons = [];
$families = [];

$dsn = "mysql:host=127.0.0.1;dbname=family_db;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    // Fetch only families with ID 1 and 2
    $stmtFamilies = $pdo->prepare("SELECT family_id, family_name, description, created_date FROM families WHERE family_id IN (1, 2) ORDER BY family_id");
    $stmtFamilies->execute();
    $families = $stmtFamilies->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if persons are in session (from backend), otherwise query from database
    if (isset($_SESSION['persons']) && !empty($_SESSION['persons'])) {
        $persons = $_SESSION['persons'];
        unset($_SESSION['persons']); // Clear after use
    } else {
        $stmt = $pdo->query("SELECT person_id, first_name, last_name FROM persons ORDER BY first_name");
        $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Database error: " . $e->getMessage();
} finally {
    if (isset($pdo)) {
        $pdo = null;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family System Data Entry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7f6;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5em;
            font-weight: 600;
        }

        .form-section {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 25px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }

        .form-section h2 {
            color: #34495e;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            width: auto; /* Override inline-block width */
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: calc(100% - 22px); /* Account for padding and border */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            margin-right: 10px;
        }

        button[type="reset"] {
            background-color: #6c757d;
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        button[type="reset"]:hover {
            background-color: #5a6268;
        }

        button:active {
            transform: translateY(0);
        }

        .message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <h1>Family System Data Entry</h1>

    <?php
    // Display feedback message from session
    if (isset($_SESSION['message'])) {
        $class = strpos($_SESSION['message'], 'Error') === 0 ? 'error' : 'message';
        echo "<p class='$class'>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }
    ?>

    <div class="form-section">
        <h2>Person Information</h2>
        <p style="color: #6c757d; font-style: italic; margin-bottom: 15px;">Note: Only Family 1 and Family 2 are available. Families cannot be created or updated.</p>
        <form method="post" action="process_form.php">
            <label for="person_family_id">Family:</label>
            <select id="person_family_id" name="family_id" required>
                <option value="">-- Select Family --</option>
                <?php foreach ($families as $family): ?>
                    <option value="<?php echo htmlspecialchars($family['family_id']); ?>">
                        <?php echo htmlspecialchars($family['family_name']); ?> (ID: <?php echo htmlspecialchars($family['family_id']); ?>)
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth"><br>

            <label for="date_of_death">Date of Death:</label>
            <input type="date" id="date_of_death" name="date_of_death"><br>

            <label for="place_of_birth">Place of Birth:</label>
            <input type="text" id="place_of_birth" name="place_of_birth"><br>

            <button type="submit" name="add_person">Add Person</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <div class="form-section">
        <h2>Contact Information</h2>
        <form method="post" action="process_form.php">
            <label for="person_id">Person:</label>
          <select name="person_id" id="person_id" required>
              <option value="">-- Select Person --</option>
                                <?php foreach ($persons as $p): ?>
                                        <?php $full_name = htmlspecialchars($p['first_name'] . ' ' . $p['last_name']); ?>
                                        <option value="<?= $full_name ?>"><?= $full_name ?></option>
                                <?php endforeach; ?>
         </select>

           
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone"><br>

            <label for="contact_type">Contact Type:</label>
            <select id="contact_type" name="contact_type" required>
                <option value="Primary">Primary</option>
                <option value="Secondary">Secondary</option>
                <option value="Work">Work</option>
                <option value="Other">Other</option>
            </select><br>

            <button type="submit" name="add_contact">Add Contact</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <div class="form-section">
        <h2>Address Information</h2>
        <form method="post" action="process_form.php">
            <label for="address_person_id">Person:</label>
            <select name="person_id" id="address_person_id" required>
                <option value="">-- Select Person --</option>
                <?php foreach ($persons as $p): ?>
                    <?php $full_name = htmlspecialchars($p['first_name'] . ' ' . $p['last_name']); ?>
                    <option value="<?= $full_name ?>"><?= $full_name ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="street_address">Street Address:</label>
            <input type="text" id="street_address" name="street_address" required><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city"><br>

            <label for="state_county">State/County:</label>
            <input type="text" id="state_county" name="state_county"><br>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country"><br>

            <button type="submit" name="add_address">Add Address</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <div class="form-section">
        <h2>Relationship Information</h2>
        <form method="post" action="process_form.php">
            <label for="person_id_1">Person 1:</label>
            <select name="person_id_1" id="person_id_1" required>
                <option value="">-- Select Person --</option>
                <?php foreach ($persons as $p): ?>
                    <?php $full_name = htmlspecialchars($p['first_name'] . ' ' . $p['last_name']); ?>
                    <option value="<?= $full_name ?>"><?= $full_name ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="person_id_2">Person 2:</label>
            <select name="person_id_2" id="person_id_2" required>
                <option value="">-- Select Person --</option>
                <?php foreach ($persons as $p): ?>
                    <?php $full_name = htmlspecialchars($p['first_name'] . ' ' . $p['last_name']); ?>
                    <option value="<?= $full_name ?>"><?= $full_name ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="relationship_type">Relationship Type:</label>
            <select id="relationship_type" name="relationship_type" required>
                <option value="Parent-Child">Parent-Child</option>
                <option value="Spouse">Spouse</option>
                <option value="Sibling">Sibling</option>
                <option value="Other">Other</option>
            </select><br>

            <button type="submit" name="add_relationship">Add Relationship</button>
            <button type="reset">Clear</button>
        </form>
    </div>
</body>
</html>