<?php
# ==========================================================================
# 1. OPTIMAL SERVER-SIDE DATABASE PROCESSING LOOP
# ==========================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_submit_inquiry'])) {
    $host = "localhost";
    $db_user = "root";
    $db_pass = ""; 
    $db_name = "kibati_db";

    // Fast database gateway initialization
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("XAMPP Database Connection Failure: " . $conn->connect_error);
    }

    // Strict parameter cleaning scripts protect server rows safely
    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $email = mysqli_real_escape_string($conn, $_POST['client_email']);
    $service = mysqli_real_escape_string($conn, $_POST['service_type']);
    $specs = mysqli_real_escape_string($conn, $_POST['project_specs']);

    $stmt = $conn->prepare("INSERT INTO service_inquiries (client_name, email_address, selected_service, project_specs) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $service, $specs);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirects perfectly straight to your success validation panel
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
  <title>Our Capabilities - Kibati Constructors</title>
  <!-- Verified layout css sheet links -->
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="services.css">
</head>
<body>

  <!-- ==========================================
       2. TOP STICKY NAVBAR NAVIGATION
       ========================================== -->
  <nav class="navbar">
    <div class="nav-logo">Kibati Constructors</div>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="burger-menu">
      <span></span><span></span><span></span>
    </label>
    <div class="nav-links">
      <!-- FIXED: Extensions mapped exactly to active .php backend files to prevent 404 errors -->
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php" style="color: var(--primary-gold); font-weight: 700;">Services</a>
      <a href="projects.php">Projects</a>
      <a href="reviews.php">Reviews</a>
      <a href="contact.php">Contact</a>
    </div>
  </nav>

  <!-- PAGE HERO BANNER -->
  <header class="page-banner">
    <div class="banner-content">
      <span class="eyebrow-text">WHAT WE DELIVER</span>
      <h1>Our Engineering Capabilities</h1>
      <p class="banner-sub">Delivering infrastructure safely, on schedule, and completely on budget.</p>
    </div>
  </header>

  <!-- ==========================================
       3. DETAILED CIVIL LAYOUT ROWS (Pre-linked)
       ========================================== -->
  <main class="services-container">
    
    <!-- SERVICE LAYER 01: Asphalt Paving -->
    <div class="service-display-row">
      <div class="text-block">
        <span class="row-indicator">01</span>
        <h2>Asphalt Laying & Paving</h2>
        <p>Deploying advanced hot-mix asphalt concrete paving machinery to deliver high-durability, premium-wearing surfaces for highways, town access roads, and industrial logistics parks across Uganda.</p>
        <div class="pill-group">
          <span>Highway Paving</span>
          <span>Hot-Mix Application</span>
          <span>Industrial Logistics Parks</span>
          <span>Surface Compaction</span>
        </div>
        <a href="#dynamic-quote-form-panel" class="action-cta-btn" onclick="switchFormContext('Asphalt Paving', 'Enter asphalt area metrics, layer thickness requirements, or road segment lengths (e.g., 5 KM highway overlay phase)...')">Request A Paving Quote</a>
      </div>
      <div class="visual-block">
        <img src="images/Asphalt.jpg" alt="Asphalt Laying">
      </div>
    </div>

    <!-- SERVICE LAYER 02: Road Grading -->
    <div class="service-display-row alternating-reverse">
      <div class="text-block">
        <span class="row-indicator">02</span>
        <h2>Road Grading & Leveling</h2>
        <p>Utilizing precision heavy motor graders to establish optimal subgrade soil stabilization, compaction densities, and civil earthwork level boundaries engineered to withstand heavy axle loads.</p>
        <div class="pill-group">
          <span>Subgrade Stabilization</span>
          <span>Motor Grader Operations</span>
          <span>Compaction Profiling</span>
          <span>Earthwork Boundaries</span>
        </div>
        <a href="#dynamic-quote-form-panel" class="action-cta-btn" onclick="switchFormContext('Road Grading & Leveling', 'Enter grading scope parameters, total land clearing level space, or site subgrade conditions...')">Inquire Road Works</a>
      </div>
      <div class="visual-block">
        <img src="images/level.jpg" alt="Motor Grader Heavy Road Grading">
      </div>
    </div>

    <!-- SERVICE LAYER 03: Stormwater Drainage -->
    <div class="service-display-row">
      <div class="text-block">
        <span class="row-indicator">03</span>
        <h2>Stormwater Drainage Channels</h2>
        <p>Engineering reinforced concrete cast-in-situ open ditches and trapezoidal drainage paths designed to intercept, channel, and safely discharge torrential storm runoff.</p>
        <div class="pill-group">
          <span>Concrete Catchment</span>
          <span>Cast-in-Situ Ditches</span>
          <span>Trapezoidal Channels</span>
          <span>Runoff Interception</span>
        </div>
        <a href="#dynamic-quote-form-panel" class="action-cta-btn" onclick="switchFormContext('Stormwater Drainage', 'Enter expected drainage installation metrics, profile styles, or culvert ditch masonry thickness paths...')">Plan Drainage Network</a>
      </div>
      <div class="visual-block">
        <img src="images/storm-drain.jpg" alt="Stormwater Drainage">
      </div>
    </div>

    <!-- SERVICE LAYER 04: Culvert Installation -->
    <div class="service-display-row alternating-reverse">
      <div class="text-block">
        <span class="row-indicator">04</span>
        <h2>Concrete Culvert Installation</h2>
        <p>Excavating and laying heavy-duty, pre-cast concrete ring culverts and structural pipe cross-drains equipped with wing-walls to prevent erosion underneath roadway pathways.</p>
        <div class="pill-group">
          <span>Precast Rings</span>
          <span>Cross-Drain Infrastructure</span>
          <span>Erosion Control Wing-walls</span>
          <span>Deep Trench Excavation</span>
        </div>
        <a href="#dynamic-quote-form-panel" class="action-cta-btn" onclick="switchFormContext('Culvert Installation', 'Enter required concrete pipe structural ring diameters, unit counts, or deep trench depth bounds...')">Inquire Culvert Project</a>
      </div>
      <div class="visual-block">
        <img src="images/culvert-installation.jpg" alt="Concrete Culvert Installation">
      </div>
    </div>

    <!-- ==========================================
         4. DYNAMIC CONTEXT-AWARE FORM CONSOLE
         ========================================== -->
    <section id="dynamic-quote-form-panel" style="background: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); max-width: 700px; margin: 80px auto 0 auto; border-top: 4px solid var(--primary-gold, #FFD700);">
      <h2 id="form-header-title" style="font-size: 1.8rem; margin: 0 0 10px 0; color: #121212; font-weight: 800;">Request a Civil Quote</h2>
      <p id="form-header-sub" style="color: #666; font-size: 0.95rem; margin-bottom: 25px;">Fill out the structural specifications below to route your service request cleanly.</p>
      
      <form action="services.php" method="POST" id="dynamic-intake-form" style="display: flex; flex-direction: column; gap: 15px;">
        <input type="hidden" name="action_submit_inquiry" value="1">
        
        <!-- Hidden input token switches values dynamically on click path -->
        <input type="hidden" name="service_type" id="hidden-service-field" value="General Civil Inquiry">

        <input type="text" name="client_name" placeholder="Your Name" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required>
        <input type="email" name="client_email" placeholder="Your Email Address" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required>
        
        <textarea name="project_specs" id="dynamic-textarea" placeholder="Detail your project dimensions, delivery timeline, or site location constraints..." rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required></textarea>
        
        <button type="submit" class="action-cta-btn highlight-gold" style="border: none; cursor: pointer; width: 100%; text-align: center; padding: 14px; font-weight: 700;">Submit Inquiry Record</button>
      </form>
    </section>

  </main>

  <!-- ==========================================
       5. CONTEXT CLOSING PANEL FOOTER (Fixed Alignment)
       ========================================== -->
  <footer class="compact-baseline-footer">
    <div class="cta-footer-content">
      <h3>READY TO BUILD?</h3>
      <p>Get in touch with our engineering team in Hoima District today to schedule a detailed blueprint assessment or structure audit framework.</p>
      <!-- FIXED: Fully mapped to scroll and switch titles to General Comprehensive Consultation -->
