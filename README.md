# Library Management System (DBMS Lab Project)

## Technology
- Frontend: HTML5, CSS3, Bootstrap 5, JavaScript
- Backend: PHP 8+ (PDO)
- Database: MySQL / MariaDB
- Local server: XAMPP

## Installation on Windows (XAMPP)
1. Install and open XAMPP.
2. Start **Apache** and **MySQL**.
3. Copy the folder `library_management_system` into `C:\xampp\htdocs\`.
4. Open `http://localhost/phpmyadmin`.
5. Choose **Import**, select `database/library_management_system.sql`, then click **Import**.
6. Check `config/config.php`. Default XAMPP MySQL credentials are host `localhost`, user `root`, blank password. If yours differ, edit them.
7. Open `http://localhost/library_management_system/`.

## Default Admin
- Email: `admin@library.local`
- Password: `password`

**Important:** This is a demonstration account. Change the password before presenting or using the system outside a local class demo. Do not expose the app publicly with the demo credentials.

## Student account
1. Open the home page and choose Student Login.
2. Click Create student account.
3. Register using a unique email and Student ID.
4. Log in as Admin and open Students.
5. Approve the new student account.
6. Student can now log in.

## Main features
### Student
- Separate student login and dashboard
- Browse and search books
- Request reservations
- View own current loans and borrowing history
- View own fines and payments
- Update profile (name, phone, department)

### Admin
- Separate admin login and dashboard
- View library summary
- Add books and book copies
- Approve / disable student accounts
- Issue and return books
- Automatic due date based on settings
- Fine calculation on late return
- Record full or partial fine payments
- Manage reservations
- View category, popular-book and overdue reports
- Configure loan days, fine per day and maximum books setting

## Notes / limitations to disclose in demo
- Online payment gateway is not integrated; Admin records payments received at the library.
- Email/SMS notifications and QR/barcode scanning are not integrated.
- Reservation is a request workflow; Admin updates its status.
- Fine is calculated when an overdue book is returned. The system shows overdue days in the student's loan page before return.
- `max_books` is stored as a library setting for configuration; the basic issue workflow does not yet block issues after the limit. Verify this rule manually in a demo or add enforcement before final submission.
- Authors and `book_authors` are included in the relational database for the ER model; this starter interface does not yet include author CRUD.
- Use real screenshots from your own running system for the report and presentation.

## Required SQL operations for viva
The schema and project support CREATE TABLE and INSERT; the application performs SELECT, WHERE, ORDER BY, UPDATE, DELETE and JOIN. Example aggregate and GROUP BY queries are in `database/extra_queries.sql`.

## Security basics
- Passwords are stored using PHP `password_hash`.
- Queries use PDO prepared statements.
- Session IDs are regenerated after login.
- CSRF tokens protect POST forms.
- Server-side role checks separate Admin and Student pages.
- Keep the project on localhost for the course demonstration.

## UI redesign and book cover images

The redesigned interface uses a clean navy/indigo theme with responsive navigation, dashboard cards and book cards. Admins can upload a cover image while adding a book. Accepted formats are JPG, PNG and WEBP, maximum 3 MB. Uploaded files are stored under `uploads/covers/`; students see the uploaded cover in Browse Books. If no image is uploaded, the interface displays a styled title placeholder.

### If you already imported the previous database
Do not import the full `library_management_system.sql` again because it drops and recreates the tables. Instead, open phpMyAdmin, select `library_management_system`, choose Import, and import `database/add_book_cover_column.sql` once. This adds the `cover_image` column required by the redesigned book pages.

### If this is a fresh installation
Import the updated `database/library_management_system.sql`; it already includes the `cover_image` column. Do not run the migration file again.

Make sure the `uploads/covers` folder is writable by Apache/PHP. On a standard Windows XAMPP installation it is normally writable by default.


## New features and one-time database update

For an existing installation, select the `library_management_system` database in phpMyAdmin and import `database/add_project_features.sql` once. This adds the `must_change_password` field used by admin-created student accounts. Do not re-import the full setup SQL into a database that already contains project data.

### Student accounts
- Students can register themselves; their account stays PENDING until Admin approves it.
- Admin can also create a student account from **Student Accounts**. The system generates a temporary password and activates the account. Give the temporary password to the student securely. On first login, the student is required to set a personal password.
- Admin can disable accounts or reset a student's password. A reset also requires the student to change the temporary password after login.

### Book catalogue and quantity
- Add a title once and enter its initial physical quantity. Each physical copy receives its own unique barcode.
- The system generates a unique 13-digit **internal catalog ISBN/code** automatically. It is an internal identifier, not a publisher-issued ISBN.
- A duplicate book title is rejected. Use **Add** or **Remove** in the inventory row to change quantity. Only AVAILABLE copies can be removed; issued/damaged/lost copies are protected.

### Notes
- Profile fields now safely handle blank or NULL student ID, phone and department values.
- Use PHP 8+ and MySQL/MariaDB through XAMPP. Ensure `uploads/covers` is writable for cover uploads.
- PHP syntax validation is performed on the project files; run the application in XAMPP and test the workflows with your own database before demonstration.
