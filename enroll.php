<?php
require_once 'includes/db_connect.php';

// fetch courses for dropdown
$courses = $pdo->query("SELECT id, title, fees FROM courses ORDER BY title ASC")->fetchAll();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $course_id = (int)$_POST['course_id'];
    $paid_fees = (int)$_POST['paid_fees'];
    $join_date = date('Y-m-d');

    // get course fees and title
    $stmt = $pdo->prepare("SELECT title, fees FROM courses WHERE id = ?");
    $stmt->execute([$course_id]);
    $course = $stmt->fetch();

    if(!$course){
        $error = "Selected course not found.";
    } else {
        $total = (int)$course['fees'];
        $pending = $total - $paid_fees;

        // insert into students table
        $ins = $pdo->prepare("INSERT INTO students (name, mobile, email, course_id, paid_fees, pending_fees, join_date, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $ok = $ins->execute([$name, $mobile, $email, $course_id, $paid_fees, $pending, $join_date]);

        if($ok){
            header("Location: search.php?mobile=".urlencode($mobile));
            exit;
        } else {
            $error = "Failed to enroll student.";
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Enroll Student - PM Smart</title>
<link rel="stylesheet" href="assets/style.css"></head>
<body>
<header class="navbar"><div class="navbar-inner container"><div class="brand">PM Smart</div><div class="hamburger" onclick="toggleNav()">☰</div><nav class="nav-links" id="navLinks"><a href="index.php">Home</a><a href="courses.php">Courses</a><a href="jobs.php">Jobs</a><a href="search.php" class="btn-search">Search Your Data</a></nav></div></header>

<section class="section container">
  <div class="title">Enroll Course</div>
  <div style="margin-top:16px" class="contact-card">
    <?php if(!empty($error)): ?><div style="color:#b91c1c;margin-bottom:10px"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <input type="text" name="name" placeholder="Full name" required>
        <input type="text" name="mobile" placeholder="Mobile number" required>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px">
        <input type="email" name="email" placeholder="Email address" required>
        <select name="course_id" id="course_id" onchange="updateFees()" required>
          <option value="">-- Select Course --</option>
          <?php foreach($courses as $c): ?>
            <option value="<?= $c['id'] ?>" data-fee="<?= $c['fees'] ?>"><?= htmlspecialchars($c['title']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px">
        <input type="number" id="total_fees" placeholder="Total fees" readonly>
        <input type="number" name="paid_fees" id="paid_fees" placeholder="Paid fees" oninput="calcPending()" required>
      </div>
      <div style="margin-top:12px;display:flex;justify-content:flex-end">
        <button class="btn-primary" type="submit">Enroll Now</button>
      </div>
    </form>
  </div>
</section>

<footer class="footer"><div class="container">&copy; <?= date('Y') ?> PM Smart</div></footer>
<script>
function toggleNav(){document.getElementById('navLinks').classList.toggle('show');}
function updateFees(){
  const sel = document.getElementById('course_id');
  const fee = sel.options[sel.selectedIndex].dataset.fee || 0;
  document.getElementById('total_fees').value = fee;
  calcPending();
}
function calcPending(){
  const total = parseFloat(document.getElementById('total_fees').value) || 0;
  const paid = parseFloat(document.getElementById('paid_fees').value) || 0;
  // optional: prevent negative
  if(paid > total) document.getElementById('paid_fees').value = total;
}
</script>
</body>
</html>
