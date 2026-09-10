<?php
# ==========================================================================
# 1. LEAN SERVER-SIDE PROCESSING MODULE (Saves Directly to MySQL Database)
# ==========================================================================
$message_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_submit_form'])) {
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
    $message = mysqli_real_escape_string($conn, $_POST['project_message']);

    $stmt = $conn->prepare("INSERT INTO contact_submissions (client_name, email_address, project_message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: thankyou.html");
        exit();
    } else {
        $message_status = "Error processing submission layer.";
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
  <title>Kibati Constructors</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  <!-- Top Navigation Bar -->
  <nav class="navbar">
    <div class="nav-logo">Kibati Constructors</div>
    
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="burger-menu">
      <span></span>
      <span></span>
      <span></span>
    </label>

    <div class="nav-links">
      <!-- Fixed Menu Routing Track: Maps exactly to your live files -->
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php">Services</a>
      <a href="projects.html">Projects</a>
      <a href="reviews.php">Reviews</a>
      <a href="contact.html">Contact</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero" id="hero">
    <img src="Copilot_20260905_193246.png" alt="Construction site at sunset" class="hero-bg">
    <div class="hero-content">
      <span class="hero-brand-tag">KIBATI CONSTRUCTORS</span>
      <h1>We Build With Safety</h1>
      <p>Residential, commercial, and civil works — delivered on schedule, on budget, and built to last.</p>
      <a href="#contact" class="btn btn-primary">Request a Quote</a>
      <a href="projects.html" class="btn btn-secondary">See Our Work</a>
      <!-- Fixed Target: This now links cleanly straight to your projects.html portfolio -->
      <a href="projects.html" class="btn btn-secondary">Our Capabilities</a>
    </div>
    <div class="hero-icons">
      <img src="Copilot_20260905_192943.png" alt="Safety helmet" class="float-icon">
      <img src="Copilot_20260905_192948.png" alt="Crane icon" class="float-icon">
      <img src="Copilot_20260905_193237.png" alt="Blueprint icon" class="float-icon">
    </div>
  </header>

  <!-- Projects Section (Infinite Ribbon Slider Track) -->
  <section id="projects" class="ribbon-slider">
    <div class="ribbon-track">
      
      <div class="ribbon-item">
        <img src="Copilot_20260905_193358.png" alt="Marula Ridge Homes">
        <span class="caption">Marula Ridge Homes</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_193246.png" alt="Northgate Hub">
        <span class="caption">Northgate Hub</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_193237.png" alt="Kamiti Access Road">
        <span class="caption">Kamiti Access Road</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_192928.png" alt="Civil works road construction">
        <span class="caption">Civil Infrastructure</span>
      </div>

      <!-- EXACT DUPLICATE SET: Required for the infinite marquee trick to work cleanly -->
      <div class="ribbon-item">
        <img src="Copilot_20260905_193358.png" alt="Marula Ridge Homes">
        <span class="caption">Marula Ridge Homes</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_193246.png" alt="Northgate Hub">
        <span class="caption">Northgate Hub</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_193237.png" alt="Kamiti Access Road">
        <span class="caption">Kamiti Access Road</span>
      </div>
      <div class="ribbon-item">
        <img src="Copilot_20260905_192928.png" alt="Civil works road construction">
        <span class="caption">Civil Infrastructure</span>
      </div>

    </div>
  </section>

  <!-- Services Section -->
  <section id="services">
    <h2>Our Services</h2>
    <div class="compact-grid">
      <div class="compact-card">
        <h3>Residential</h3>
        <p>Modern homes built with precision, top safety guidelines, and master craftsmanship.</p>
      </div>
      <div class="compact-card">
        <h3>Commercial</h3>
        <p>Office complexes and industrial warehouses engineered for maximum operations efficiency.</p>
      </div>
      <div class="compact-card">
        <h3>Civil Works</h3>
        <p>High-standard roads, comprehensive drainage solutions, and sustainable infrastructure developments.</p>
      </div>
    </div>
  </section>

  <!-- Client Reviews Testimonials Section -->
  <section id="testimonials" class="testimonials-sec">
    <h2>What Our Clients Say</h2>
    <div class="compact-grid">
      <div class="compact-card testimonial-card">
        <div class="star-rating">★★★★★</div>
        <p class="review-text">"Kibati Constructors delivered our warehouse extension assembly exactly on budget. Their on-site safety execution framework was highly commendable."</p>
        <h4 class="client-name">— Engineering Director, Northgate Hub</h4>
      </div>
      <div class="compact-card testimonial-card">
        <div class="star-rating">★★★★★</div>
        <p class="review-text">"Outstanding craftsmanship on the Marula residential phase. Professional management updates kept our investment panels assured throughout."</p>
        <h4 class="client-name">— Private Developer</h4>
      </div>
    </div>
  </section>

  <!-- Upgraded Footer Section with Form & Map Layout Integration -->
  <footer class="site-footer" id="contact" style="background-image: linear-gradient(rgba(26, 26, 26, 0.85), rgba(26, 26, 26, 0.95)), url('Copilot_20260905_193358.png');">
    
    <div class="footer-brand-card">
      <div class="footer-grid">
        
        <!-- Left Column: Contact Details & Input Form -->
        <div class="footer-form-col">
          <h3>KIBATI CONSTRUCTORS</h3>
          <p class="contact-meta">Phone: +256 700 000 000 | 0763476203&nbsp;|&nbsp; Email: info@kibaticonstructors.com</p>
          <p class="contact-location">Hoima District, Uganda</p>
          
          <form class="contact-form" action="Homepage.php" method="POST">
            <input type="hidden" name="action_submit_form" value="1">
            <input type="text" name="client_name" placeholder="Your Name" required autocomplete="name">
            <input type="email" name="client_email" placeholder="Your Email Address" required autocomplete="email">
            <textarea name="project_message" placeholder="Project Details or Message..." rows="4" required></textarea>
            <button type="submit" class="btn btn-primary form-submit">Send Message</button>
          </form>
        </div>

        <!-- Right Column: High-Performance Google Maps Embed Frame -->
        <div class="footer-map-col">
          <div class="map-container">
            <iframe 
              src="https://google.com" 
              style="border: none; width: 100%; height: 100%; border-radius: 4px;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
              title="Kibati Constructors Office Location Map">
            </iframe>
          </div>
          <small><a href="https://google.com" target="_blank" style="color: var(--primary-gold); text-decoration: none; font-size: 0.75rem; display: block; margin-top: 8px;">View Larger Map</a></small>
        </div>

      </div>
    </div>

    <!-- Sleek Single-Line Navigation row -->
    <div class="footer-nav-row">
      <a href="Homepage.php#hero">Home</a>
      <a href="services.php">Services</a>
      <a href="projects.php">Projects</a>
      <a href="reviews.php">Reviews</a>
      <a href="contact.php">Contact</a>
    </div>

    <!-- Bottom Accent Layout Bar -->
    <div class="footer-bottom-bar">
      <p>&copy; 2026 Kibati Constructors. All Rights Reserved.</p>
      <p style="color: var(--primary-gold); font-weight: 700; font-size: 0.85rem; letter-spacing: 1px;">SAFETY & EXCELLENCE</p>
    </div>
  </footer>

</body>
</html>
