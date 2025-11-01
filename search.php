<?php
require_once 'includes/db_connect.php';
$student = null;
$mobile = $_GET['mobile'] ?? null;
if($mobile){
    $mobile = trim($mobile);
    $sql = "SELECT s.*, c.title AS course_title, c.fees AS course_fees
            FROM students s
            LEFT JOIN courses c ON s.course_id = c.id
            WHERE s.mobile = :mobile LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['mobile'=>$mobile]);
    $student = $stmt->fetch();
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Search Student - PM Smart</title>
<link rel="stylesheet" href="assets/style.css"></head>
<body>
<header class="navbar"><div class="navbar-inner container"><div class="brand">PM Smart</div><div class="hamburger" onclick="toggleNav()">☰</div><nav class="nav-links" id="navLinks"><a href="index.php">Home</a><a href="courses.php">Courses</a><a href="jobs.php">Jobs</a><a href="search.php" class="btn-search">Search Your Data</a></nav></div></header>

<section class="section container">
  <div class="title">Search Your Data</div>
  <div style="margin-top:14px;max-width:720px;margin-left:auto;margin-right:auto">
    <form method="GET" class="contact-card" style="display:flex;gap:10px;flex-direction:column">
      <input type="text" name="mobile" placeholder="Enter mobile number " required value="<?= htmlspecialchars($mobile ?? '') ?>">
      <div style="display:flex;gap:10px;justify-content:flex-end">
        <button class="btn-primary" type="submit">Find Student</button>
      </div>
    </form>

    <?php if($mobile && !$student): ?>
      <div style="margin-top:12px" class="contact-card">No record found for this mobile number.</div>
    <?php elseif($student): ?>
      <div style="margin-top:12px" class="contact-card">
        <div style="display:flex;gap:18px;align-items:center">
          <div style="width:140px">
            <img src="<?= !empty($student['photo']) ? 'uploads/'.htmlspecialchars($student['photo']) : 'assets/avatar-placeholder.png' ?>" style="width:100%;border-radius:10px">
          </div>
          <div style="flex:1">
            <h3><?= htmlspecialchars($student['name']) ?></h3>
            <p><strong>Mobile:</strong> <?= htmlspecialchars($student['mobile']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
            <p><strong>Course:</strong> <?= htmlspecialchars($student['course_title'] ?? '-') ?></p>
            <p><strong>Total Fees:</strong> ₹<?= htmlspecialchars($student['course_fees'] ?? $student['paid_fees']) ?></p>
            <p><strong>Paid:</strong> ₹<?= htmlspecialchars($student['paid_fees']) ?></p>
            <p><strong>Pending:</strong> ₹<?= htmlspecialchars($student['pending_fees']) ?></p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<footer class="footer"><div class="container">&copy; <?= date('Y') ?> PM Smart</div></footer>
<script>function toggleNav(){document.getElementById('navLinks').classList.toggle('show');}</script>
</body>
</html>
