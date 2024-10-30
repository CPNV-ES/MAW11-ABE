# MAW11-ABE

## Description

This project is a recreation of a website called "Exercise Looper." Its main functions include creating new exercises, allowing users to answer existing exercises, and displaying the answers to those exercises.

## Getting Started

### Prerequisites

-   PHP Version: 8.3.11
-   Xdebug Version: 3.3.2
-   IDE: Visual Studio Code
-   Package Manager: Composer

### Configuration

-   **Database Setup**: The project uses a `.env` file to store database credentials. It is up to the developer to choose the database engine and set the corresponding credentials in the `.env` file.

    Example `.env` configuration:

    ```env
    DATABASE_HOST=127.0.0.1
    DATABASE_PORT=3306
    DATABASE_NAME=your_database_name
    DATABASE_USERNAME=your_username
    DATABASE_PASSWORD=your_password
    ```

## Deployment

### On dev environment

1. Clone the repository.

```bash
git clone https://github.com/CPNV-ES/MAW11-ABE
cd MAW11-ABE
```

2. Use the Composer command to install the dependencies:

```bash
composer install
```

3. Rename the .env.example file to .env.

```bash
cp .env.example .env
```

4. Run the web project locally using:

```bash
php -S localhost:8888 -t public
```

## Directory structure

The project follows the MVC (Model-View-Controller) structure:

```shell
├───public
│   ├───css
│   ├───img
│   └───index.php
└───src
    ├───Controllers
    ├───Models
    └───Views
└───tests
```

## Collaborate

-   If you found an issue, want to request different functionality or other, please create a GitHub issue.
-   If you want to add new features yourself, please create a pull request.
-   There are no specific guidelines for contributing to this project.

## Contact

If you need to contact me, send me an email at:

-   arthur.bottemanne@eduvaud.ch
