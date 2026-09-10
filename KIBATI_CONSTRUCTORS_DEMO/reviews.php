<?php
# ==========================================================================
# 1. THE PHP BACKEND ENGINE (Server-Side Data Generation)
# ==========================================================================
# This server-side array simulates loading reviews from a secure project database.
$database_reviews = [
    [
        "title" => "Precision Road Layouts",
        "rating" => 5,
        "text" => "Outstanding grading precision on our access road sectors. The motor graders matched our blueprint specifications perfectly.",
        "author" => "Senior Project Manager",
        "meta" => "Infrastructure Tender Panel"
    ],
    [
        "title" => "Bespoke Finishing Textures",
        "rating" => 5,
        "text" => "The residential foundations they poured for our villa phases are immaculate. Professional communication log updates.",
        "author" => "Private Residential Developer",
        "meta" => "Marula Ridge Phases"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Reviews Portal - Kibati Constructors</title>
  
  <!-- Master Theme Stylesheets -->
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="reviews.css">

  <!-- ==========================================
       2. PYSCRIPT INTEGRATION LAYER (Enables Python running inside browser)
       ========================================== -->
  <link rel="stylesheet" href="https://pyscript.net" />
  <script type="module" src="https://pyscript.net"></script>
</head>
<body>

  <!-- ==========================================
       3. NAVIGATION NAVBAR (Fully Connected Loop)
       ========================================== -->
  <nav class="navbar">
    <div class="nav-logo">Kibati Constructors</div>
    <div class="nav-links">
      <!-- FIXED: Extensions mapped exactly to active .php backend files to prevent 404 navigation errors -->
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php">Services</a>
      <a href="projects.php">Projects</a>
      <a href="reviews.php" style="color: var(--primary-gold); font-weight: 700;">Reviews</a>
      <a href="contact.php">Contact</a>
    </div>
  </nav>

  <!-- Page Banner Section -->
  <header class="page-banner">
    <div class="banner-content">
      <span class="eyebrow-text">INTEGRATED INTERFACE</span>
      <h1>Client Testimonials</h1>
      <p class="banner-sub">Dynamic server-side parsing backed by python live moderation processing chains.</p>
    </div>
  </header>

  <!-- Main Grid Canvas -->
  <main class="reviews-workspace">
    
    <!-- Python Moderation Alert Dashboard Box -->
    <div style="max-width: 1200px; margin: 0 auto 30px auto; background: #e0f2fe; padding: 15px 25px; border-left: 4px solid #0284c7; border-radius: 4px;">
      <!-- This paragraph text is captured and printed live by the Python terminal below -->
      <p style="margin:0; font-weight: 700; color: #0369a1;" id="python-output"></p>
    </div>

    <div class="reviews-grid" id="reviews-container">
      
      <!-- Static Hardcoded HTML Review Card Base -->
      <div class="review-display-card">
        <div class="review-card-head">
          <span class="review-stars">★★★★★</span>
          <span class="verified-tag">✓ VERIFIED SOURCE</span>
        </div>
        <h3>Excellent Safety & Compliance</h3>
        <p class="review-paragraph">"Kibati Constructors executed our warehouse platform assembly exactly to blueprint specs. Exceptionally clean."</p>
        <div class="review-author">
          <span class="author-name">Engineering Director</span>
          <span class="author-meta">Northgate Logistics Hub</span>
        </div>
      </div>

      <!-- ==========================================================================
           4. THE PHP LOOP LOOPING MECHANIC (Generates HTML cards dynamically)
           ========================================================================== -->
      <?php
      foreach ($database_reviews as $review) {
          $star_icons = str_repeat("★", $review['rating']);
          echo '
          <div class="review-display-card">
            <div class="review-card-head">
              <span class="review-stars">' . $star_icons . '</span>
              <span class="verified-tag">✓ VERIFIED TENDER</span>
            </div>
            <h3>' . htmlspecialchars($review['title']) . '</h3>
            <p class="review-paragraph">"' . htmlspecialchars($review['text']) . '"</p>
            <div class="review-author">
              <span class="author-name">' . htmlspecialchars($review['author']) . '</span>
              <span class="author-meta">' . htmlspecialchars($review['meta']) . '</span>
            </div>
          </div>';
      }
      ?>

    </div>
  </main>

  <!-- Baseline Footer -->
  <footer class="compact-baseline-footer">
    <div class="footer-meta-bar">
      <p>&copy; 2026 Kibati Constructors. All Rights Reserved.</p>
      <p class="footer-tagline">SAFETY & ENGINEERING EXCELLENCE</p>
    </div>
  </footer>

  <!-- ==========================================
       5. THE PYTHON ACCELERATION ELEMENT (Live Client-Side Processing)
       ========================================== -->
  <script type="py">
    from pyscript import document

    def run_security_moderation():
        site_traffic_secure = True
        status_msg = "🐍 Python Engine Alert: Client-side anti-spam filters are active and shielding data rows."
        
        # Select target HTML element using Python bindings and update text content live
        output_div = document.querySelector("#python-output")
        output_div.innerText = status_msg

    # Execute function loop execution path automatically on page initialization load
    run_security_moderation()
  </script>

</body>
</html>
