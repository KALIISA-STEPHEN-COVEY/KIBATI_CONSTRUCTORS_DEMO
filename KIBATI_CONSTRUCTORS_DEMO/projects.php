<?php
# ==========================================================================
# 1. OPTIMAL PORTFOLIO BACKEND ENGINE (Saves Inquiries to MySQL)
# ==========================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_project_inquiry'])) {
    $host = "localhost";
    $db_user = "root";
    $db_pass = ""; 
    $db_name = "kibati_db";

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Local Database Connection Failed: " . $conn->connect_error);
    }

    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $email = mysqli_real_escape_string($conn, $_POST['client_email']);
    $project = mysqli_real_escape_string($conn, $_POST['project_name']);
    $message = mysqli_real_escape_string($conn, $_POST['custom_message']);

    $stmt = $conn->prepare("INSERT INTO portfolio_inquiries (client_name, email_address, interested_project, custom_message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $project, $message);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
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
  <title>Our Projects - Kibati Constructors</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="projects.css">
  <style>
    /* Premium Action Prompt Link Overlay */
    .project-inquire-link {
      display: inline-block;
      margin-top: 15px;
      font-size: 0.85rem;
      font-weight: 700;
      color: var(--primary-gold, #FFD700);
      text-decoration: none;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: opacity 0.3s ease;
      cursor: pointer;
    }
    .project-inquire-link:hover {
      opacity: 0.8;
    }
  </style>
</head>
<body>

  <!-- ==========================================
       2. NAVIGATION NAVBAR (Fully Connected Loop)
       ========================================== -->
  <nav class="navbar">
    <div class="nav-logo">Kibati Constructors</div>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="burger-menu">
      <span></span><span></span><span></span>
    </label>
    <div class="nav-links">
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php">Services</a>
      <a href="projects.php" style="color: var(--primary-gold); font-weight: 700;">Projects</a>
      <a href="reviews.php">Reviews</a>
      <a href="contact.php">Contact</a>
    </div>
  </nav>

  <!-- MINIMALIST PORTFOLIO HERO -->
  <header class="page-banner">
    <div class="banner-content">
      <span class="eyebrow-text">PROVEN RECORD</span>
      <h1>Our Infrastructure Portfolio</h1>
      <p class="banner-sub">Safely delivered civil engineering, road networks, and municipal works across Uganda.</p>
    </div>
  </header>

  <!-- INTERACTIVE CATEGORY FILTER NAVIGATION -->
  <div class="filter-wrapper">
    <button class="filter-btn active" data-filter="all">All Works</button>
    <button class="filter-btn" data-filter="roads">Road Projects</button>
    <button class="filter-btn" data-filter="drainage">Drainage & Civil</button>
    <button class="filter-btn" data-filter="buildings">Commercial Buildings</button>
  </div>

  <!-- ==========================================
       3. PORTFOLIO SHOWCASE GRID
       ========================================== -->
  <main class="portfolio-container">
    <div class="portfolio-grid" id="portfolio-grid">
      
      <!-- Project 1: Asphalt Paving -->
      <div class="portfolio-card" data-category="roads">
        <div class="portfolio-img-box"><img src="images/Asphalt.jpg" alt="Asphalt Laying"></div>
        <div class="portfolio-info">
          <span class="project-tag">Road Works</span>
          <h3>Hoima Urban Road Paving</h3>
          <p>Heavy-duty asphalt overlay, surface leveling, and subgrade stabilization to improve local transit logistics.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Hoima Urban Road Paving')">Inquire About This Work &rarr;</a>
        </div>
      </div>

      <!-- Project 2: Road Grading -->
      <div class="portfolio-card" data-category="roads">
        <div class="portfolio-img-box"><img src="images/level.jpg" alt="Motor Grader Grading"></div>
        <div class="portfolio-info">
          <span class="project-tag">Earthworks</span>
          <h3>Kamiti Access Route Leveling</h3>
          <p>Precision clearing, cut-and-fill operations, and grading execution to secure raw transport lines for heavy haulers.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Kamiti Access Route Leveling')">Inquire About This Work &rarr;</a>
        </div>
      </div>

      <!-- Project 3: Storm Drainage -->
      <div class="portfolio-card" data-category="drainage">
        <div class="portfolio-img-box"><img src="images/storm-drain.jpg" alt="Storm Drainage"></div>
        <div class="portfolio-info">
          <span class="project-tag">Drainage</span>
          <h3>Municipal Stormwater Channels</h3>
          <p>Engineering reinforced concrete cast-in-situ open ditches and trapezoidal drainage paths designed to safely discharge runoff.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Municipal Stormwater Channels')">Inquire About This Work &rarr;</a>
        </div>
      </div>

      <!-- Project 4: Culvert Installation -->
      <div class="portfolio-card" data-category="drainage">
        <div class="portfolio-img-box"><img src="images/culvert-installation.jpg" alt="Culvert Installation"></div>
        <div class="portfolio-info">
          <span class="project-tag">Civil Engineering</span>
          <h3>Cross-Drainage Culvert Placement</h3>
          <p>Excavating and laying heavy-duty, pre-cast concrete ring culverts and structural pipe cross-drains equipped with wing-walls.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Cross-Drainage Culvert Placement')">Inquire About This Work &rarr;</a>
        </div>
      </div>

      <!-- Project 5: Marula Ridge -->
      <div class="portfolio-card" data-category="buildings">
        <div class="portfolio-img-box"><img src="Copilot_20260905_193358.png" alt="Marula Ridge Homes"></div>
        <div class="portfolio-info">
          <span class="project-tag">Residential</span>
          <h3>Marula Ridge Homes</h3>
          <p>Modern residential estate phase built with premium architectural calculations and turnkey structural excellence.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Marula Ridge Homes')">Inquire About This Work &rarr;</a>
        </div>
      </div>

      <!-- Project 6: Northgate Hub -->
      <div class="portfolio-card" data-category="buildings">
        <div class="portfolio-img-box"><img src="Copilot_20260905_193246.png" alt="Northgate Hub"></div>
        <div class="portfolio-info">
          <span class="project-tag">Commercial</span>
          <h3>Northgate Industrial Hub</h3>
          <p>High-efficiency workspaces, corporate office blocks, and heavy-duty logistics warehouses optimized for operations.</p>
          <a class="project-inquire-link" onclick="openProjectConsole('Northgate Industrial Hub')">Inquire About This Work &rarr;</a>
        </div>
      </div>

    </div>

    <!-- ==========================================
         4. DYNAMIC PORTFOLIO INTAKE CONSOLE FORM
         ========================================== -->
    <section id="portfolio-quote-panel" style="background: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); max-width: 700px; margin: 80px auto 0 auto; border-top: 4px solid var(--primary-gold, #FFD700);">
      <h2 id="project-form-title" style="font-size: 1.8rem; margin: 0 0 10px 0; color: #121212; font-weight: 800;">Project Specification Inquiry</h2>
      <p style="color: #666; font-size: 0.95rem; margin-bottom: 25px;">Are you interested in a specific layout execution or structural design listed above? Submit your requirements below.</p>
      
      <form action="projects.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        <input type="hidden" name="action_project_inquiry" value="1">
        
        <!-- Automated hidden project tracker field input -->
        <input type="hidden" name="project_name" id="hidden-project-field" value="General Portfolio Inquiry">

        <input type="text" name="client_name" placeholder="Your Name" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required>
        <input type="email" name="client_email" placeholder="Your Email Address" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required>
        
        <textarea name="custom_message" placeholder="Type your specific comment, question, or custom scope specifications about this project asset..." rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px;" required></textarea>
        
        <button type="submit" class="action-cta-btn highlight-gold" style="border: none; cursor: pointer; width: 100%; text-align: center; padding: 14px; font-weight: 700; text-transform: uppercase;">Transmit Project Inquiry</button>
      </form>
    </section>
  </main>

  <!-- Baseline Footer Bar -->
  <footer class="compact-baseline-footer" style="background: #121212; padding: 60px 5% 40px 5%; text-align: center; color: #ffffff; border-top: 3px solid var(--primary-gold);">
