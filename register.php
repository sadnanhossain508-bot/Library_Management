<?php
require_once __DIR__.'/includes/auth.php';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();
$name=trim($_POST['full_name']??'');$email=trim($_POST['email']??'');$phone=trim($_POST['phone']??'');$student_no=trim($_POST['student_no']??'');$department=trim($_POST['department']??'');$password=$_POST['password']??'';
if(strlen($password)<8){flash('danger','Password must contain at least 8 characters.');redirect('/register.php');}
try{$s=$pdo->prepare("INSERT INTO users(full_name,email,password_hash,role,status,phone,student_no,department) VALUES(?,?,?,'student','PENDING',?,?,?)");
$s->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT),$phone,$student_no,$department]);flash('success','Registration submitted. Please wait for Admin approval.');redirect('/login.php?role=student');
}catch(PDOException $e){flash('danger','Email or student ID already exists.');redirect('/register.php');}}
$page_title='Student Registration';require __DIR__.'/includes/header.php';
?>
<div class="row justify-content-center"><div class="col-md-7"><div class="card p-4"><h2>Student Registration</h2><p class="text-muted">Your account will remain pending until Admin approval.</p>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="row"><div class="col-md-6 mb-3"><label>Full Name</label><input class="form-control" name="full_name" required></div><div class="col-md-6 mb-3"><label>Student ID</label><input class="form-control" name="student_no" required></div>
<div class="col-md-6 mb-3"><label>Email</label><input class="form-control" type="email" name="email" required></div><div class="col-md-6 mb-3"><label>Phone</label><input class="form-control" name="phone"></div>
<div class="col-md-6 mb-3"><label>Department</label><input class="form-control" name="department"></div><div class="col-md-6 mb-3"><label>Password (min 8 chars)</label><input class="form-control" type="password" name="password" minlength="8" required></div></div>
<button class="btn btn-primary">Submit Registration</button></form></div></div></div>
<?php require __DIR__.'/includes/footer.php'; ?>
