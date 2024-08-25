##Login and Sign-Up System with PHP, MySQL, and Bootstrap


User Registration: Users can create an account by providing their details. Passwords are securely hashed before being stored in the MySQL database.

User Authentication: Users can log in with their credentials. After logging out, users cannot access the dashboard without logging in again, ensuring session security.

Session Management: Sessions are used to maintain user login status. Users cannot bypass login by directly accessing the dashboard URL.

Password Hashing: Passwords are hashed using PHP's password hashing functions, enhancing security by preventing plain-text storage.

Logout Functionality: Secure logout option to ensure that the session is destroyed and cannot be reused


Future Enhancements
Email-Only Account Creation: Users will be able to create an account using only their email address. Login credentials will be sent to the user’s email.

Password Change on First Login: After receiving login credentials via email, users will be required to change their password on first login for added security.
