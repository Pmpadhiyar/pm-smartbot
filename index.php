<?php
require_once 'includes/db_connect.php';

// latest 3 courses
$courses = $pdo->query("SELECT id, title, description, duration, fees FROM courses ORDER BY created_at DESC LIMIT 3")->fetchAll();

// placed students - jobs (latest 4)
$jobs = $pdo->query("SELECT j.id, s.name AS student_name, s.photo, j.company, j.role, j.salary 
                     FROM jobs j 
                     LEFT JOIN students s ON j.student_id = s.id
                     ORDER BY j.id DESC LIMIT 4")->fetchAll();

// reviews
$reviews = $pdo->query("SELECT id, name, rating, message FROM reviews WHERE approved = 1 ORDER BY created_at DESC LIMIT 4")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>PM Smart Institute</title>

<!-- Main CSS -->
<link rel="stylesheet" href="assets/style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<style>
 .footer {
  background: linear-gradient(90deg, var(--primary), var(--primary-2));
  color: #fff;
  text-align: center;
  padding: 10px 10px 12px; /* 👈 height बहुत कम कर दी */
  margin-top: 40px;
  border-radius: 10px;
}

.footer .brand-name {
  font-size: 20px; /* छोटा किया */
  font-weight: 700;
  margin-bottom: 2px;
}

.footer .tagline {
  font-size: 14px;
  opacity: 0.8;
  margin-bottom: 8px;
}

.footer .social-links {
  display: flex;
  justify-content: center;
  gap: 18px;
  margin-bottom: 8px;
}

.footer .social-links a {
  color: #fff;
  font-size: 25px; /* icon size छोटा किया */
  transition: 0.3s ease;
}

.footer .social-links a:hover {
  color: #ffe600;
  transform: scale(1.1);
}

.footer hr {
  width: 50%;
  margin: 6px auto;
  border: 0;
  height: 1px;
  background: rgba(255, 255, 255, 0.2);
}

.footer .copyright {
  font-size: 11px;
  opacity: 0.7;
}


</style>
<body>

<!-- NAVBAR -->
<header class="navbar">
  <div class="navbar-inner container">
    <div class="brand">PM Smart</div>
    <div class="hamburger" onclick="toggleNav()">☰</div>

    <nav class="nav-links" id="navLinks">
      <a href="index.php" class="active">Home</a>
      <a href="about.php">About</a>
      <a href="courses.php">Courses</a>
      <a href="jobs.php">Jobs</a>
      <a href="#contact">Contact</a>
      <a href="search.php" class="btn-search">Search Your Data</a>
    </nav>
  </div>
</header>

<!-- HERO -->
<section class="hero container">
  <div class="hero-left">
    <h1>Build real projects. Learn web development the smart way.</h1>
    <p>Practical PHP, MySQL, Frontend skills and placement support — designed for students and working professionals.</p>
    <div class="hero-cta">
      <a href="courses.php" class="btn-primary">Explore Courses</a>
      <a href="#contact" class="btn-outline">Contact Us</a>
    </div>
  </div>
  <div class="hero-right">
    <div class="hero-card">
      <img src="assets/images/pm institute 2.jpg" alt="Students coding or classroom">
    </div>
  </div>
</section>

<!-- COURSES -->
<section class="section container">
  <div class="title">Our Popular Courses</div>
  <div class="course-grid" style="margin-top:16px">
    <?php if(!empty($courses)): foreach($courses as $c): ?>
      <div class="course-card">
        <h3><?= htmlspecialchars($c['title']) ?></h3>
        <p><?= strlen($c['description'])>120 ? htmlspecialchars(substr($c['description'],0,120)).'...' : htmlspecialchars($c['description']) ?></p>
        <div class="course-meta">
          <div>Duration: <?= htmlspecialchars($c['duration']) ?></div>
          <div class="badge">₹<?= htmlspecialchars($c['fees']) ?></div>
        </div>
      </div>
    <?php endforeach; else: ?>
      <p>No courses found.</p>
    <?php endif; ?>
  </div>
</section>

<!-- JOBS -->
<section class="section" style="background:linear-gradient(180deg,#f7fbff,#fff);">
  <div class="container">
    <div class="title">Students Placed from PM Smart</div>
    <div class="job-grid" style="margin-top:16px">
      <?php if(!empty($jobs)): foreach($jobs as $j): ?>
        <div class="job-card">
          <img src="<?= 'assets/images/' . basename($j['photo']) ?>" alt="photo">
          <h4><?= htmlspecialchars($j['student_name'] ?? 'Student') ?></h4>
          <div class="job-role"><?= htmlspecialchars($j['role'] ?? 'Role') ?></div>
          <p>Company: <?= htmlspecialchars($j['company'] ?? '-') ?></p>
          <p>Salary: <?= htmlspecialchars($j['salary'] ?? '-') ?></p>
        </div>
      <?php endforeach; else: ?>
        <p>No placed students yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- REVIEWS -->
<section class="section container">
  <div class="title">Student Reviews</div>
  <div class="review-grid" style="margin-top:16px">
    <?php if(!empty($reviews)): foreach($reviews as $r): ?>
      <div class="review-card">
        <div class="review-stars">
          <?php for($i=1;$i<=5;$i++): echo $i <= $r['rating'] ? '★' : '☆'; endfor; ?>
        </div>
        <h4 style="color:var(--primary);margin-bottom:8px"><?= htmlspecialchars($r['name']) ?></h4>
        <p style="color:var(--muted)"><?= htmlspecialchars($r['message']) ?></p>
      </div>
    <?php endforeach; else: ?>
      <p>No reviews yet.</p>
    <?php endif; ?>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="section container">
  <div class="title">Contact Us</div>
  <div class="contact-card">
    <form id="contactForm">
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
      </div>

      <div style="display:flex;gap:14px;margin-top:14px;flex-wrap:wrap;">
        <input type="text" name="mobile" placeholder="Your Mobile Number" required>
        <input type="text" name="subject" placeholder="Subject (optional)">
      </div>

      <textarea name="message" placeholder="Write your message here..." rows="5" required style="margin-top:14px;"></textarea>
      <div style="margin-top:16px;text-align:right;">
        <button type="submit">Send Message</button>
      </div>
    </form>
    <div id="formMessage" style="margin-top:14px;font-weight:600;text-align:center;"></div>
  </div>
</section>

<!-- ✅ FOOTER START --><!-- ✅ FOOTER START -->
<footer class="footer">
  <div class="container">
    <h2 class="brand-name">PM Smart Institute</h2>
    <p class="tagline">Learn. Build. Get Placed.</p>

    <div class="social-links">
      <a href="https://wa.me/918128676273" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      <a href="https://www.instagram.com/invites/contact/?igsh=2o93w5416qdd&utm_content=memrnlq" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="https://www.facebook.com/share/1FiFnJf2Yk/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="https://x.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
    </div>

    <hr>
    <p class="copyright">© <?= date('Y') ?> PM Smart Institute. All Rights Reserved.</p>
  </div>
</footer>
<!-- ✅ FOOTER END -->

<!-- ✅ FOOTER END -->

<script>
function toggleNav(){
  document.getElementById('navLinks').classList.toggle('show');
}

document.getElementById("contactForm").addEventListener("submit", async function(e){
  e.preventDefault();
  const form = e.target;
  const msg = document.getElementById("formMessage");
  msg.innerHTML = "<span style='color:#007bff;'>⏳ Sending...</span>";

  try {
    const res = await fetch("contact_submit.php", { method: "POST", body: new FormData(form) });
    const data = await res.json();
    if (data.status === "success") {
      msg.innerHTML = "<span style='color:green;'>✅ Message sent successfully!</span>";
      form.reset();
    } else {
      msg.innerHTML = "<span style='color:red;'>❌ " + (data.message || 'Error occurred') + "</span>";
    }
  } catch (err) {
    msg.innerHTML = "<span style='color:red;'>⚠️ Network error. Please try again.</span>";
  }
});
</script>

</body>
</html>
