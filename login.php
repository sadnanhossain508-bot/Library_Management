<?php
require_once __DIR__.'/includes/auth.php';
$role=($_GET['role']??$_POST['role']??'student'); if(!in_array($role,['student','admin'],true)) $role='student';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();$email=trim($_POST['email']??'');$password=$_POST['password']??'';
if(attempt_login($pdo,$email,$password,$role)){log_activity($pdo,'LOGIN','User logged in');redirect($role==='admin'?'/admin/dashboard.php':'/student/dashboard.php');}
flash('danger','Invalid credentials or account is not active.');redirect('/login.php?role='.$role);}
$page_title=ucfirst($role).' Login';require __DIR__.'/includes/header.php';
?>
<div class="row justify-content-center"><div class="col-md-5"><div class="card p-4"><h2 class="mb-1"><?= e(ucfirst($role)) ?> Login</h2><p class="text-muted">Enter your registered credentials.</p>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="role" value="<?= e($role) ?>">
<div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required></div>
<div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
<button class="btn btn-primary w-100">Login</button></form>
<?php if($role==='student'): ?><p class="mt-3 mb-0">New student? <a href="<?= BASE_URL ?>/register.php">Register here</a></p><?php endif; ?>
<a class="d-block mt-3" href="<?= BASE_URL ?>/index.php">← Back to role selection</a></div></div></div>
<?php require __DIR__.'/includes/footer.php'; ?>
