<?php
require_once __DIR__.'/includes/auth.php'; require_login();
$u=current_user();
if($_SERVER['REQUEST_METHOD']==='POST'){
 verify_csrf(); $old=$_POST['current_password']??''; $new=$_POST['new_password']??''; $confirm=$_POST['confirm_password']??'';
 $st=$pdo->prepare('SELECT password_hash FROM users WHERE id=?'); $st->execute([$u['id']]); $hash=$st->fetchColumn();
 if(!password_verify($old,$hash)){flash('danger','Current password is incorrect.');redirect('/change_password.php');}
 if(strlen($new)<8){flash('danger','New password must be at least 8 characters.');redirect('/change_password.php');}
 if($new!==$confirm){flash('danger','New password and confirmation do not match.');redirect('/change_password.php');}
 $pdo->prepare('UPDATE users SET password_hash=?,must_change_password=0 WHERE id=?')->execute([password_hash($new,PASSWORD_DEFAULT),$u['id']]);
 $_SESSION['user']['must_change_password']=0; flash('success','Password changed successfully.'); redirect($u['role']==='admin'?'/admin/dashboard.php':'/student/dashboard.php');
}
$page_title='Change Password'; require __DIR__.'/includes/header.php'; ?>
<div class="row justify-content-center"><div class="col-lg-6"><div class="card p-4"><div class="section-kicker">SECURITY</div><h2 class="mb-2">Create your password</h2><p class="text-muted">For account security, set a personal password before continuing.</p><form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><div class="mb-3"><label class="form-label">Temporary / current password</label><input class="form-control" type="password" name="current_password" required></div><div class="mb-3"><label class="form-label">New password</label><input class="form-control" type="password" name="new_password" minlength="8" required></div><div class="mb-4"><label class="form-label">Confirm new password</label><input class="form-control" type="password" name="confirm_password" minlength="8" required></div><button class="btn btn-primary w-100">Update password</button></form></div></div></div>
<?php require __DIR__.'/includes/footer.php'; ?>