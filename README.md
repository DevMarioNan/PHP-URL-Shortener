
# URL Shortener

<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" height="30" width="42" alt="html5 logo"  />
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" height="30" width="42" alt="css3 logo"  />
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" height="30" width="42" alt="tailwindcss logo"  />
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="30" width="42" alt="php logo"  />
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" height="30" width="42" alt="mysql logo"  />

## Description

This is a simple URL shortener built with PHP and MySQL. It provides an easy way to shorten URLs and tracks the number of times each shortened URL is clicked. The project also includes a contact page, protected by authentication, where users can reach out.

## Features

- URL shortening and redirection.
- Tracks the number of clicks for each shortened URL.
- Authentication system with sign-up and sign-in functionality.
- Contact page with email notifications using PHPMailer.
- Responsive design using TailwindCSS.

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL
- Composer

### Setting Up

1. Clone the repository:

```bash
git clone https://github.com/DevMarioNan/PHP-URL-Shortener.git
```

2. Navigate to the project directory:

```bash
cd PHP-URL-Shortener
```

3. Install dependencies using Composer:

```bash
composer install
```

4. Set up your MySQL database and import the `database.sql` file located in the `src/Database` directory.

5. Update the `config.php` file with your database credentials:

```php
return [
    'db_host' => 'localhost',
    'db_name' => 'url_shortener',
    'db_user' => 'root',
    'db_pass' => '',
];

```

6. Set up your SMTP credentials for the contact page to work:

```php
$mail->Host = "smtp.mailersend.net";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = 'your_smtp_username';
$mail->Password = 'your_smtp_password';
$mail->setFrom('your_email_from_the_smtp', $name);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->addAddress("your_contact_email@example.com");
```

### Authentication Setup

To add authentication to your project, ensure you have the necessary tables in your MySQL database:

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) DEFAULT NULL,
    role VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
)
```

### URL Table Setup

to add the table that will handle storing and dealing with the URLS:

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) DEFAULT NULL,
    role VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
)
```

### Running the Project

You can now run the project on your local server using:

Open your browser and go to `http://localhost/PHP-URL-Shortener` to start using the URL shortener.

## License

This project is licensed under the MIT License.

