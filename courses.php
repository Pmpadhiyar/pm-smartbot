<?php
require_once 'includes/db_connect.php';
$courses = $pdo->query("SELECT id, title, description, duration, fees FROM courses ORDER BY created_at DESC")->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Courses - PM Smart</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- ✅ Courses Section -->
<section class="section container">
  <div class="title">All Courses</div>
  <div class="course-grid" style="margin-top:16px">
    <?php foreach($courses as $c): ?>
      <div class="course-card">
        <h3><?= htmlspecialchars($c['title']) ?></h3>
        <p><?= htmlspecialchars(substr($c['description'],0,200)) ?>...</p>

        <div class="course-meta">
          <div>⏱ <?= htmlspecialchars($c['duration']) ?></div>
          <div class="badge">₹<?= htmlspecialchars($c['fees']) ?></div>
        </div>

        <div style="margin-top:15px; display:flex; gap:10px;">
          <a href="enroll.php?course_id=<?= $c['id'] ?>" class="btn-primary">Enroll Now</a>
          <a href="course_detail.php?id=<?= $c['id'] ?>" class="btn-outline">View Details</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ✅ Footer -->
<footer class="footer">
  <div class="container">&copy; <?= date('Y') ?> PM Smart</div>
</footer>

<script>
function toggleNav(){
  document.getElementById('navLinks').classList.toggle('show');
}
</script>

</body>
</html>
