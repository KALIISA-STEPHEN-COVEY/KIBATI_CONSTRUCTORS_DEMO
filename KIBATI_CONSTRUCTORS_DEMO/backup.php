<?php
# ==========================================================================
# 1. OPTIMAL DATABASE BACKUP ENGINE (Generates Raw .sql Data Dumps)
# ==========================================================================
$host = "localhost";
$db_user = "root";
$db_pass = ""; 
$db_name = "kibati_db";

// Open secure connection matrix to your XAMPP MySQL server
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Database Connection Bottleneck: " . $conn->connect_error);
}

// 1. Force the server charset to UTF-8 to preserve all special text formatting
$conn->set_charset("utf8");

// 2. Identify the active tables to extract from kibati_db
$tables = ['contact_submissions', 'service_inquiries', 'portfolio_inquiries', 'client_reviews', 'tender_submissions'];
$sql_backup_output = "-- Kibati Constructors Database Backup Dump\n";
$sql_backup_output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql_backup_output .= "CREATE DATABASE IF NOT EXISTS `$db_name`;\n";
$sql_backup_output .= "USE `$db_name`;\n\n";

// 3. Loop through tables and compile data rows
foreach ($tables as $table) {
    // Check if table exists before querying it to prevent syntax crashes
    $table_check = $conn->query("SHOW TABLES LIKE '$table'");
    if ($table_check->num_rows == 0) {
        continue; 
    }

    // Get table structure to generate CREATE TABLE drops
    $row_structure = $conn->query("SHOW CREATE TABLE `$table`")->fetch_row();
    $sql_backup_output .= "DROP TABLE IF EXISTS `$table`;\n";
    $sql_backup_output .= $row_structure[1] . ";\n\n";

    // Fetch data rows from table columns
    $result = $conn->query("SELECT * FROM `$table`");
    $column_count = $result->field_count;

    while ($row = $result->fetch_row()) {
        $sql_backup_output .= "INSERT INTO `$table` VALUES(";
        for ($i = 0; $i < $column_count; $i++) {
            if (isset($row[$i])) {
                // Sanitize text values to escape quotes safely
                $row[$i] = addslashes($row[$i]);
                $row[$i] = str_replace("\n", "\\n", $row[$i]);
                $sql_backup_output .= '"' . $row[$i] . '"';
            } else {
                $sql_backup_output .= 'NULL';
            }
            if ($i < ($column_count - 1)) {
                $sql_backup_output .= ',';
            }
        }
        $sql_backup_output .= ");\n";
    }
    $sql_backup_output .= "\n\n";
}

// 4. Create local folder directory to save the file
$backup_directory = 'backups/';
if (!is_dir($backup_directory)) {
    mkdir($backup_directory, 0777, true);
}

// Save file using an automated chronological timestamp string
$file_title = $backup_directory . 'kibati_db_backup_' . date('Y-m-d_H-i-s') . '.sql';
$file_handle = fopen($file_title, 'w+');

if (fwrite($file_handle, $sql_backup_output)) {
    fclose($file_handle);
    $conn->close();
    
    // Output standard confirmation card view layout parameters
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Backup Successful</title>
      <link rel="stylesheet" href="style1.css">
    </head>
    <body style="background:#121212; min-height:100vh; display:flex; align-items:center; justify-content:center; font-family:inherit;">
      <div style="background:#fff; max-width:480px; width:100%; padding:40px; border-radius:8px; text-align:center; border-top:4px solid #FFD700;">
        <span style="font-size:3rem;">💾</span>
        <h2 style="margin:15px 0 10px 0; font-weight:800;">Backup Routine Complete</h2>
        <p style="color:#666; font-size:0.95rem; line-height:1.5; margin-bottom:25px;">Your site leads, portfolio inquiries, and review database records have been securely backed up inside your server files folder directory.</p>
        <div style="background:#fafafa; padding:12px; border-radius:4px; font-family:monospace; font-size:0.85rem; border:1px solid #ddd; margin-bottom:25px; word-break:break-all; color:#333;">'.$file_title.'</div>
        <a href="admin.php" class="btn btn-primary" style="text-decoration:none; display:inline-block; font-weight:700; text-transform:uppercase; font-size:0.85rem; letter-spacing:0.5px; padding:12px 30px;">Return to Admin Console</a>
      </div>
    </body>
    </html>';
    exit();
} else {
    fclose($file_handle);
    $conn->close();
    die("System Error writing backup output data stream lines.");
}
?>
