# BlockVerse Tasks

- Laravel 10 (PHP 8.1+)
- Laravel Passport

### Step 1: Clone the repository

```bash
git clone git@github.com:Faruque5698/BlockVerse-Tasks.git
cd BlockVerse-Tasks
```
### Step 2: Copy the example environment file

```bash
cp .env.example .env
```
### Step 3: Install dependencies

```bash
composer install
```
### Step 4: Generate application key

```bash
php artisan key:generate
```

### Step 5: Configure your database
Edit the `.env` file to set your database connection details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Your_DB_Name
DB_USERNAME=Your_DB_Username
DB_PASSWORD=Your_DB_Password
```

### Step 6: Run migrations

```bash
php artisan migrate
```

### Step 7: Seed the database 
Seeder for admin login credentials
```bash
php artisan db:seed
```
Amin credentials
```json
{
    "email": "admin@example.com",
    "password": "password" 
}
```
### Step 7: Passport Client Generate
```bash
php artisan passport:install
```


