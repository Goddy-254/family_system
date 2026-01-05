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

    // Family form - Completely disabled: Cannot update or create families
    if (isset($_POST['add_family'])) {
        $_SESSION['message'] = "Error: Family creation and updates are not allowed. Only the existing two families can be used.";
    }

    // Person form
    if (isset($_POST['add_person'])) {
        $family_id = trim($_POST['family_id'] ?? '');
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $gender = $_POST['gender'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        $date_of_death = $_POST['date_of_death'] ?? null;
        $place_of_birth = trim($_POST['place_of_birth'] ?? '');

        if (empty($family_id) || empty($first_name) || empty($last_name) || empty($gender) || empty($date_of_birth) || empty($place_of_birth)) {
            $_SESSION['message'] = "Error: Family ID, First Name, Last Name, Gender, Date of Birth, and Place of Birth are required.";
        } elseif (!is_numeric($family_id)) {
            $_SESSION['message'] = "Error: Family ID must be a number.";
        } elseif ($family_id !== '1' && $family_id !== '2') {
            $_SESSION['message'] = "Error: Only Family ID 1 and Family ID 2 are available. Cannot use other family IDs.";
        } else {
            // Verify the family exists in database (must be ID 1 or 2)
            $stmtCheckFamily = $pdo->prepare("SELECT family_id FROM families WHERE family_id = ?");
            $stmtCheckFamily->execute([$family_id]);
            if (!$stmtCheckFamily->fetchColumn()) {
                $_SESSION['message'] = "Error: Selected family does not exist in the database. Only Family 1 and Family 2 are available.";
            } else {
                // Check for duplicate person name (first_name + last_name)
                $stmtCheck = $pdo->prepare('SELECT person_id FROM persons WHERE first_name = ? AND last_name = ?');
                $stmtCheck->execute([$first_name, $last_name]);
                if ($stmtCheck->fetchColumn()) {
                    $_SESSION['message'] = "Error: Person '" . $first_name . " " . $last_name . "' already exists. Duplicate names are not allowed.";
                } else {
                    $stmt = $pdo->prepare("INSERT INTO persons (family_id, first_name, last_name, gender, date_of_birth, date_of_death, place_of_birth) VALUES (:family_id, :first_name, :last_name, :gender, :date_of_birth, :date_of_death, :place_of_birth)");
                    $stmt->execute([
                        'family_id' => $family_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'gender' => $gender,
                        'date_of_birth' => $date_of_birth,
                        'date_of_death' => $date_of_death,
                        'place_of_birth' => $place_of_birth,
                    ]);
                    $_SESSION['message'] = "Person '" . $first_name . " " . $last_name . "' added successfully!";
                }
            }
        }
    }

    // Contact form
    if (isset($_POST['add_contact'])) {
        $person_full_name = trim($_POST['person_id'] ?? '');
        $email = trim($_POST['email'] ?? '') ?: null;
        $phone = trim($_POST['phone'] ?? '') ?: null;
        $contact_type = $_POST['contact_type'] ?? '';

        if (empty($person_full_name) || empty($contact_type) || (empty($email) && empty($phone))) {
            $_SESSION['message'] = "Error: Person, Contact Type, and at least one of Email or Phone are required.";
        } else {
            // Split full name into first and last name
            $name_parts = explode(' ', $person_full_name, 2);
            $first_name = trim($name_parts[0] ?? '');
            $last_name = trim($name_parts[1] ?? '');
            
            // Look up person by first and last name
            $stmtCheck = $pdo->prepare('SELECT person_id FROM persons WHERE first_name = ? AND last_name = ?');
            $stmtCheck->execute([$first_name, $last_name]);
            $person_id = $stmtCheck->fetchColumn();
            
            if (!$person_id) {
                $_SESSION['message'] = "Error: Person not found.";
            } else {
                $stmt = $pdo->prepare('INSERT INTO contacts (person_id, email, phone, contact_type) VALUES (:person_id, :email, :phone, :contact_type)');
                $stmt->execute([
                    'person_id' => $person_id,
                    'email' => $email,
                    'phone' => $phone,
                    'contact_type' => $contact_type,
                ]);
                $_SESSION['message'] = "Contact information added successfully!";
                
                // Select all persons after insert and store in session
                $stmtPersons = $pdo->query("SELECT person_id, first_name, last_name FROM persons ORDER BY first_name");
                $_SESSION['persons'] = $stmtPersons->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    // Address form
    if (isset($_POST['add_address'])) {
        $person_full_name = trim($_POST['person_id'] ?? '');
        $street_address = trim($_POST['street_address'] ?? '');
        $city = trim($_POST['city'] ?? '') ?: null;
        $state_county = trim($_POST['state_county'] ?? '') ?: null;
        $country = trim($_POST['country'] ?? '') ?: null;

        if (empty($person_full_name) || empty($street_address)) {
            $_SESSION['message'] = "Error: Person and Street Address are required.";
        } else {
            // Split full name into first and last name
            $name_parts = explode(' ', $person_full_name, 2);
            $first_name = trim($name_parts[0] ?? '');
            $last_name = trim($name_parts[1] ?? '');
            
            // Look up person by first and last name
            $stmtCheck = $pdo->prepare('SELECT person_id FROM persons WHERE first_name = ? AND last_name = ?');
            $stmtCheck->execute([$first_name, $last_name]);
            $person_id = $stmtCheck->fetchColumn();
            
            if (!$person_id) {
                $_SESSION['message'] = "Error: Person not found.";
            } else {
                $stmt = $pdo->prepare('INSERT INTO addresses (person_id, street_address, city, state_county, country) VALUES (:person_id, :street_address, :city, :state_county, :country)');
                $stmt->execute([
                    'person_id' => $person_id,
                    'street_address' => $street_address,
                    'city' => $city,
                    'state_county' => $state_county,
                    'country' => $country,
                ]);
                $_SESSION['message'] = "Address added successfully!";
            }
        }
    }

    // Relationship form
    if (isset($_POST['add_relationship'])) {
        $person_full_name_1 = trim($_POST['person_id_1'] ?? '');
        $person_full_name_2 = trim($_POST['person_id_2'] ?? '');
        $relationship_type = $_POST['relationship_type'] ?? '';

        if (empty($person_full_name_1) || empty($person_full_name_2) || empty($relationship_type)) {
            $_SESSION['message'] = "Error: Both Persons and Relationship Type are required.";
        } elseif ($person_full_name_1 === $person_full_name_2) {
            $_SESSION['message'] = "Error: A person cannot have a relationship with themselves.";
        } else {
            // Split first person's full name into first and last name
            $name_parts_1 = explode(' ', $person_full_name_1, 2);
            $first_name_1 = trim($name_parts_1[0] ?? '');
            $last_name_1 = trim($name_parts_1[1] ?? '');
            
            // Split second person's full name into first and last name
            $name_parts_2 = explode(' ', $person_full_name_2, 2);
            $first_name_2 = trim($name_parts_2[0] ?? '');
            $last_name_2 = trim($name_parts_2[1] ?? '');
            
            // Look up first person by first and last name
            $stmtCheck1 = $pdo->prepare('SELECT person_id FROM persons WHERE first_name = ? AND last_name = ?');
            $stmtCheck1->execute([$first_name_1, $last_name_1]);
            $person_id_1 = $stmtCheck1->fetchColumn();
            
            // Look up second person by first and last name
            $stmtCheck2 = $pdo->prepare('SELECT person_id FROM persons WHERE first_name = ? AND last_name = ?');
            $stmtCheck2->execute([$first_name_2, $last_name_2]);
            $person_id_2 = $stmtCheck2->fetchColumn();
            
            if (!$person_id_1 || !$person_id_2) {
                $_SESSION['message'] = "Error: One or both persons not found.";
            } else {
                $stmt = $pdo->prepare('INSERT INTO relationships (person_id_1, person_id_2, relationship_type) VALUES (:person_id_1, :person_id_2, :relationship_type)');
                $stmt->execute([
                    'person_id_1' => $person_id_1,
                    'person_id_2' => $person_id_2,
                    'relationship_type' => $relationship_type,
                ]);
                $_SESSION['message'] = "Relationship added successfully!";
            }
        }
    }

    header('Location: family.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['message'] = "Database error: " . $e->getMessage();
    header('Location: family.php');
    exit;
}

// Close connection
$pdo = null;
?>