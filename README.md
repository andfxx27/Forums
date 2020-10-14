# Forums
A simple forum web application built with HTML, CSS (MaterializeCSS), JS (MaterializeJS), and Object Oriented PHP.

## Usage and Important Note
/config directory is included in .gitignore for security reasons (local DB server information). If you want to clone this repository and try this web application on your local PC, you can do the following actions:
1. Create config.php file inside /config directory.
2. Setup the local DB with appropriate credential. For example, this application is using MySQL bundled with XAMPP.
3. Setup the PDO Connection with the corresponding local DB server information/ credential, such as hostname, username, password, etc and put it inside variable called >$pdo
4. Enjoy.
