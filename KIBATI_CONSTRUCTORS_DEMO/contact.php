<?php
# ==========================================================================
# 1. OPTIMAL CONTACT BACKEND ENGINE (Saves Tenders Directly to MySQL)
# ==========================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_submit_tender'])) {
    $host = "localhost";
    $db_user = "root";
    $db_pass = ""; 
    $db_name = "kibati_db";

    // Initialize fast gateway connection matrix
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Local Storage Vault Connection Blocked: " . $conn->connect_error);
    }

    // Sanitize parameters securely to avoid any structural text inject risks
    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $org = mysqli_real_escape_string($conn, $_POST['client_organization'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['client_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['client_phone']);
    $scale = mysqli_real_escape_string($conn, $_POST['Project_Scale']);
    $scope = mysqli_real_escape_string($conn, $_POST['scope_details']);

    $stmt = $conn->prepare("INSERT INTO tender_submissions (client_name, organization, email_address, phone_number, project_scale, scope_details) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $org, $email, $phone, $scale, $scope);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect user smoothly to your success validation dashboard panel
        header("Location: thankyou.html");
        exit();
    } else {
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tender Intake Console - Kibati Constructors</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="contact.css">
</head>
<body>

  <!-- ==========================================
       2. NAVIGATION NAVBAR (Reviews Link Restored)
       ========================================== -->
  <nav class="navbar">
    <div class="nav-logo">Kibati Constructors</div>
    <div class="nav-links">
      <!-- FIXED: Included the missing reviews.php link to restore full cross-site tracking loops -->
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php">Services</a>
      <a href="projects.php">Projects</a>
      <a href="reviews.php">Reviews</a>
      <a href="contact.php" style="color: var(--primary-gold); font-weight: 700;">Contact</a>
    </div>
  </nav>

  <!-- Clean, Spacious White Workspace Sheet -->
  <main class="dashboard-workspace">
    <div class="dashboard-split-wrapper">
      
      <!-- LEFT WORKSPACE CANVAS: The Consultation Builder Form -->
      <div class="workspace-form-side">
        <span class="step-badge">INTAKE STEP 01</span>
        <h1 class="workspace-title">Let's blueprint your project.</h1>
        <p class="workspace-subtitle">Fill in your site specifications below to route your inquiry directly to our civil estimating desk in Hoima.</p>

        <!-- Form maps purely onto your local machine database loop engine -->
        <form class="premium-console-form" action="contact.php" method="POST">
          <input type="hidden" name="action_submit_tender" value="1">

          <!-- Row 1: Core Identification -->
          <div class="console-row">
            <div class="console-field">
              <label for="name">Your Name</label>
              <input type="text" id="name" name="client_name" placeholder="Enter full name" required>
            </div>
            <div class="console-field">
              <label for="org">Organization / Firm</label>
              <input type="text" id="org" name="client_organization" placeholder="Company or Ministry name">
            </div>
          </div>

          <!-- Row 2: Direct Contact Channels -->
          <div class="console-row">
            <div class="console-field">
              <label for="email">Secure Email</label>
              <input type="email" id="email" name="client_email" placeholder="name@domain.com" required>
            </div>
            <div class="console-field">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="client_phone" placeholder="+256..." required>
            </div>
          </div>

          <!-- INTERACTIVE BUDGET MATRIX SELECTION TRACK -->
          <div class="console-field">
            <label>Estimated Project Scale Scope</label>
            <div class="budget-matrix-grid">
              
              <!-- Minor Option Box Container -->
              <div class="matrix-item">
                <input type="radio" name="Project_Scale" id="scale-minor" value="Minor/Private Works" checked>
                <label for="scale-minor" class="matrix-box">
                  <span class="matrix-title">Minor / Private Works</span>
                  <span class="matrix-desc">Small access paths, private surfacing or local drainage installs.</span>
                </label>
              </div>

              <!-- Major Option Box Container -->
              <div class="matrix-item">
                <input type="radio" name="Project_Scale" id="scale-major" value="Major Commercial">
                <label for="scale-major" class="matrix-box">
                  <span class="matrix-title">Major Commercial</span>
                  <span class="matrix-desc">Logistics hubs, deep culvert networks, or extensive civil contracts.</span>
                </label>
              </div>

            </div>
          </div>

          <!-- Row 4: Scope Specifications Area -->
          <div class="console-field">
            <label for="scope">Site Scope Specifications</label>
            <textarea id="scope" name="scope_details" rows="4" placeholder="Detail terrain conditions, expected machine requirements, or mobilization constraints..." required></textarea>
          </div>

          <button type="submit" class="console-submit-btn">Transmit Tender Details &rarr;</button>
        </form>
      </div>

      <!-- RIGHT DASHBOARD OVERLAY: Floating Corporate Info Block -->
      <div class="workspace-info-side">
        <div class="floating-hq-card">
          <span class="hq-tag">KIBATI HEADQUARTERS</span>
          <h2>Hoima District, Uganda</h2>
          <p class="hq-sub">Operational center for equipment fleets and estimation engineers.</p>

          <div class="hq-link-row">
            <span class="hq-label">DIRECT PHONE LINES</span>
            <a href="tel:+256700000000" class="hq-value-link">+256 700 000 000</a>
            <a href="tel:+256763476203" class="hq-value-link">+256 763 476 203</a>
          </div>

          <div class="hq-link-row">
            <span class="hq-label">SECURE INBOX CHANNELS</span>
            <a href="mailto:info@kibaticonstructors.com" class="hq-value-link">info@kibaticonstructors.com</a>
            <a href="mailto:tenders@kibaticonstructors.com" class="hq-value-link">tenders@kibaticonstructors.com</a>
          </div>

          <div class="hq-link-row" style="margin-bottom: 0;">
            <span class="hq-label">QUALITY ASSURANCE TENDER CODE</span>
            <p class="hq-code-text">KC-UG-2026-CIVIL</p>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- Pristine Horizontal Minimalist Footer Bar -->
  <footer class="minimalist-bar-footer">
    <div class="footer-bar-content">
      <p class="copyright-text">&copy; 2026 Kibati Constructors. Built to last.</p>
      <p class="branding-tagline">SAFETY & ENGINEERING EXCELLENCE</p>
    </div>
  </footer>

</body>
</html>
