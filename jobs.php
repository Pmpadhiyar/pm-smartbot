<?php
require_once 'includes/db_connect.php';
$jobs = $pdo->query("SELECT j.id, s.name AS student_name, s.photo, j.company, j.role, j.salary FROM jobs j LEFT JOIN students s ON j.student_id = s.id ORDER BY j.id DESC")->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Jobs - PM Smart</title>
<link rel="stylesheet" href="assets/style.css"></head>
<body>
<section class="section container">
  <div class="title">Placed Students / Job Records</div>
  <div class="job-grid" style="margin-top:16px">
    <?php if($jobs): foreach($jobs as $j): ?>
      <div class="job-card">
        <!-- <?php var_dump($j['photo']); ?> -->

       <img src="<?= 'assets/images/' . basename($j['photo']) ?>" alt="photo" width="100" height="100">


        <h4><?= htmlspecialchars($j['student_name'] ?? 'Student') ?></h4>
        <div class="job-role"><?= htmlspecialchars($j['role'] ?? '') ?></div>
        <p>Company: <?= htmlspecialchars($j['company'] ?? '') ?></p>
        <p>Salary: <?= htmlspecialchars($j['salary'] ?? '') ?></p>
      </div>
    <?php endforeach; else: ?>
      <p>No job records.</p>
    <?php endif; ?>
  </div>
</section>
<script>function toggleNav(){document.getElementById('navLinks').classList.toggle('show');}</script>
</body>
</html>
