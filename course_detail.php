<?php
require_once "includes/db_connect.php";

if (!isset($_GET['id'])) {
    die("Invalid course ID");
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$course) {
    die("Course not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($course['title']) ?> - PM Smart</title>
<link rel="stylesheet" href="assets/style.css">
<style>
.detail-box {
  background: #fff;
  border-radius: 10px;
  padding: 40px;
  max-width: 800px;
  margin: 50px auto;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.detail-box h2 {
  color: var(--primary);
  margin-bottom: 10px;
}
.detail-box p {
  margin: 8px 0;
  color: #444;
}
.btn-back {
  display:inline-block;
  margin-top:20px;
  padding:10px 20px;
  background:var(--primary);
  color:#fff;
  border-radius:6px;
  text-decoration:none;
}
.btn-back:hover {background:var(--primary-dark);}
</style>
</head>
<body>

<div class="detail-box">
  <h2><?= htmlspecialchars($course['title']) ?></h2>
  <p><strong>Duration:</strong> <?= htmlspecialchars($course['duration']) ?></p>
  <p><strong>Fees:</strong> ₹<?= htmlspecialchars($course['fees']) ?></p>
  <p><?= nl2br(htmlspecialchars($course['description'])) ?></p>
  <a href="enroll.php?course_id=<?= $course['id'] ?>" class="btn-back">Enroll Now</a>
  <a href="courses.php" class="btn-back" style="background:#6c757d;">Back</a>
</div>

</body>
</html>
