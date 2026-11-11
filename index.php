<?php
require_once __DIR__.'/includes/auth.php';
if(current_user()) redirect(current_user()['role']==='admin'?'/admin/dashboard.php':'/student/dashboard.php');
$page_title='Welcome'; require __DIR__.'/includes/header.php'; ?>
<section class="portal-welcome">
    <div class="portal-kicker"><span></span> YOUR DIGITAL LIBRARY</div>
    <h1>Welcome to <span>LibrarySpace</span></h1>
    <p>Select your portal to continue.</p>
</section>
<div class="portal-grid">
    <section class="portal-card student-portal">
        <div class="portal-card-top">
            <div class="portal-icon"><span>▤</span></div>
            <span class="portal-tag">FOR READERS</span>
        </div>
        <div class="portal-card-body">
            <h2>Student Portal</h2>
            <p>Explore the collection, discover your next read, reserve books and keep track of your library activity.</p>
            <a class="portal-action student-action" href="<?=BASE_URL?>/login.php?role=student">Continue as Student <span>↗</span></a>
            <div class="portal-footnote">New to the library? <a href="<?=BASE_URL?>/register.php">Create a student account</a></div>
        </div>
        <div class="portal-card-watermark" aria-hidden="true">S</div>
    </section>
    <section class="portal-card admin-portal">
        <div class="portal-card-top">
            <div class="portal-icon"><span>⌘</span></div>
            <span class="portal-tag">MANAGEMENT</span>
        </div>
        <div class="portal-card-body">
            <h2>Admin Portal</h2>
            <p>Manage the catalogue, book inventory, student accounts, lending activity and library records.</p>
            <a class="portal-action admin-action" href="<?=BASE_URL?>/login.php?role=admin">Continue as Admin <span>↗</span></a>
            <div class="portal-footnote">Secure access for authorised administrators</div>
        </div>
        <div class="portal-card-watermark" aria-hidden="true">A</div>
    </section>
</div>
<div class="portal-trust-row">
    <span><i>✓</i> Organised catalogue</span>
    <span><i>✓</i> Clear book availability</span>
    <span><i>✓</i> Secure account access</span>
</div>
<?php require __DIR__.'/includes/footer.php'; ?>
