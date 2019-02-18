# LaravelBooks
Laravel project, website managing book database.

### Features
Laravel books is a website that manages a book database. Anyone can visit the website and view the list of book entries and their data, however only a registered user can create new entries, update entries and delete entries. Every registered user has equal rights, thus it would be up to the community to hanlde incorrect data and so forth.
Users can also export the book data in CSV or XML formats, according to the specified fields.

### Requirements
1) xampp
2) composer
3) cmder (if you are working on windows)

### Starting up
1) Clone this repository into your htdocs directory at "xampp\htdocs".
2) Configure your vhosts file in "xampp\apache\conf\extra\httpd-vhosts.conf".
3) Configure your hosts file in "Windows\System32\drivers\etc\hosts" (Use notepad in administrator mode).
4) Run xampp and start the Apache server.
5) In xampp start the MySQL server.
6) Open phpMyAdmin and create a database called "laravelbooks".
7) Open the LaravelBooks directory in a terminal and run "composer install".
8) Open the LaravelBooks directory in a terminal and run "php artisan migrate".
9) Run your favourite browser and go to the configured URL.
