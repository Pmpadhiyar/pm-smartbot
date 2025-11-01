<?php
require_once 'includes/db_connect.php';
header('Content-Type: application/json; charset=utf-8');

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if(!$name || !$email || !$mobile || !$message){
    echo json_encode(['status'=>'error','message'=>'All required fields must be filled.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO contacts (name,email,mobile,subject,message,seen,created_at)
                            VALUES (:n,:e,:m,:s,:msg,0,NOW())");
    $stmt->execute([
        ':n'=>$name,
        ':e'=>$email,
        ':m'=>$mobile,
        ':s'=>$subject,
        ':msg'=>$message
    ]);

    echo json_encode(['status'=>'success','message'=>'Your message has been sent successfully!']);
} catch(PDOException $e){
    echo json_encode(['status'=>'error','message'=>$e->getMessage()]);
}
?>
