<?php
# ==========================================================================
# 1. AUTHENTICATION SYSTEM GATEWAY (Configured Credentials)
# ==========================================================================
session_start();

$ADMIN_USERNAME = "COVEY";
$ADMIN_PASSWORD = "welcome1"; 

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['kibati_authenticated']);
    session_destroy();
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_challenge'])) {
    $entered_user = $_POST['auth_user'];
    $entered_pass = $_POST['auth_pass'];

    if ($entered_user === $ADMIN_USERNAME && $entered_pass === $ADMIN_PASSWORD) {
        $_SESSION['kibati_authenticated'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $auth_error = "Invalid credential parameters. Entry denied.";
    }
}

if (!isset($_SESSION['kibati_authenticated']) || $_SESSION['kibati_authenticated'] !== true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Security Access Portal - Kibati Constructors</title>
  <link rel="stylesheet" href="style1.css">
  <style>
    .lock-canvas { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #121212; padding: 0 5%; }
    .lock-card { background: #ffffff; max-width: 420px; width: 100%; padding: 40px; border-radius: 8px; box-shadow: 0 20px 60px rgba(0,0,0,0.4); border-top: 4px solid #FFD700; }
    .lock-card h2 { font-size: 1.6rem; font-weight: 800; margin: 0 0 8px 0; color: #121212; }
    .lock-card p { color: #666; font-size: 0.9rem; line-height: 1.5; margin: 0 0 25px 0; }
    .auth-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
    .auth-field label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .auth-field input { padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit; font-size: 0.95rem; }
    .auth-btn { width: 100%; background: #121212; color: #ffffff; border: none; padding: 14px; font-weight: 700; border-radius: 4px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; }
    .auth-btn:hover { background: #FFD700; color: #121212; }
  </style>
</head>
<body class="lock-canvas">
  <div class="lock-card">
    <h2>Secure Gateway</h2>
    <p>Authentication required to access the Kibati internal estimating desk console logs.</p>
    <?php if (!empty($auth_error)): ?>
      <p style="color: #dc2626; font-weight: 700; margin-bottom: 15px; font-size: 0.85rem;"><?php echo $auth_error; ?></p>
    <?php endif; ?>
    <form action="admin.php" method="POST">
      <input type="hidden" name="login_challenge" value="1">
      <div class="auth-field">
        <label>Operator Username</label>
        <input type="text" name="auth_user" required autocomplete="username">
      </div>
      <div class="auth-field">
        <label>Security Keyphrase</label>
        <input type="password" name="auth_pass" required autocomplete="current-password">
      </div>
      <button type="submit" class="auth-btn">Authorize Node</button>
    </form>
  </div>
</body>
</html>
<?php
    exit();
}

# ==========================================================================
# 2. SERVER-SIDE DATA RETRIEVAL ENGINE
# ==========================================================================
$host = "localhost";
$db_user = "root";
$db_pass = ""; 
$db_name = "kibati_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Database Connection Bottleneck: " . $conn->connect_error);
}

$contacts_result = $conn->query("SELECT * FROM contact_submissions ORDER BY created_at DESC");
$services_result = $conn->query("SELECT * FROM service_inquiries ORDER BY submitted_at DESC");
$projects_result = $conn->query("SELECT * FROM portfolio_inquiries ORDER BY submitted_at DESC");
$reviews_result  = $conn->query("SELECT * FROM client_reviews ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Corporate Desk Console - Kibati Constructors</title>
  <link rel="stylesheet" href="style1.css">
  <style>
    .admin-body { background: #f8f9fa; color: #1a1a1a; padding: 40px 4%; }
    .admin-wrapper { max-width: 1300px; margin: 0 auto; }
    .admin-header { border-bottom: 2px solid #FFD700; padding-bottom: 20px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; }
    .admin-header h1 { font-size: 2.2rem; font-weight: 800; margin: 0; letter-spacing: -0.5px; }
    .logout-btn { background: #dc2626; color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .section-vault-card { background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); border: 1px solid #eef0f2; margin-bottom: 40px; }
    .section-vault-card h2 { font-size: 1.4rem; font-weight: 800; margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-table-container { width: 100%; overflow-x: auto; }
    .matrix-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
    .matrix-table th { background: #1a1a1a; color: #ffffff; padding: 14px 16px; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .matrix-table td { padding: 14px 16px; border-bottom: 1px solid #eef0f2; color: #444444; line-height: 1.5; }
    .matrix-table tr:hover td { background: rgba(255, 215, 0, 0.02); }
    .tag-token { display: inline-block; padding: 4px 10px; font-size: 0.75rem; font-weight: 700; background: #e0f2fe; color: #0369a1; border-radius: 4px; text-transform: uppercase; }
    .tag-gold { background: #fef9c3; color: #713f12; }
    .empty-prompt { color: #888888; font-style: italic; padding: 10px 0; }
  </style>
</head>
<body class="admin-body">

  <div class="admin-wrapper">
    
    <header class="admin-header">
      <div>
        <h1>Kibati Corporate Estimating Desk</h1>
        <p style="color: #666; margin-top: 5px;">Secure aggregate view of cross-site lead tracking logs and database tables.</p>
      </div>
      <div style="display: flex; gap: 10px; align-items: center;">
        <a href="backup.php" class="logout-btn" style="background: #1b5e20;">Run DB Backup File</a>
        <a href="admin.php?action=logout" class="logout-btn">Terminate Session</a>
      </div>
    </header>

    <!-- SECTION 1: HOMEPAGE MESSAGES -->
    <section class="section-vault-card">
      <h2>01. Homepage Lead Submissions</h2>
      <div class="data-table-container">
        <table class="matrix-table">
          <thead>
            <tr>
              <th style="width: 20%;">Client Name</th>
              <th style="width: 25%;">Email Address</th>
              <th style="width: 40%;">Project Message Log</th>
              <th style="width: 15%;">Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($contacts_result && $contacts_result->num_rows > 0): ?>
              <?php while($row = $contacts_result->fetch_assoc()): ?>
                <tr>
                  <td><strong><?php echo htmlspecialchars($row['client_name']); ?></strong></td>
                  <td><a href="mailto:<?php echo htmlspecialchars($row['email_address']); ?>" style="color: #0369a1; text-decoration: none;"><?php echo htmlspecialchars($row['email_address']); ?></a></td>
                  <td><?php echo htmlspecialchars($row['project_message']); ?></td>
                  <td style="font-size: 0.85rem; color: #777;"><?php echo $row['created_at']; ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="4" class="empty-prompt">No homepage logs registered yet.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- SECTION 2: SERVICES CAPABILITY INQUIRIES -->
    <section class="section-vault-card">
      <h2>02. Services Page Capability Inquiries</h2>
      <div class="data-table-container">
        <table class="matrix-table">
          <thead>
            <tr>
              <th style="width: 20%;">Client Name</th>
              <th style="width: 25%;">Email Address</th>
              <th style="width: 20%;">Target Capability</th>
              <th style="width: 20%;">Site Scope Specifications</th>
              <th style="width: 15%;">Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($services_result && $services_result->num_rows > 0): ?>
              <?php while($row = $services_result->fetch_assoc()): ?>
                <tr>
                  <td><strong><?php echo htmlspecialchars($row['client_name']); ?></strong></td>
                  <td><a href="mailto:<?php echo htmlspecialchars($row['email_address']); ?>" style="color: #0369a1; text-decoration: none;"><?php echo htmlspecialchars($row['email_address']); ?></a></td>
                  <td><span class="tag-token tag-gold"><?php echo htmlspecialchars($row['selected_service']); ?></span></td>
                  <td><?php echo htmlspecialchars($row['project_specs']); ?></td>
                  <td style="font-size: 0.85rem; color: #777;"><?php echo $row['submitted_at']; ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="5" class="empty-prompt">No services quote requests registered yet.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- SECTION 3: PROJECTS PORTFOLIO COMMENT ENQUIRIES -->
    <section class="section-vault-card">
      <h2>03. Portfolio Card Enquiries</h2>
