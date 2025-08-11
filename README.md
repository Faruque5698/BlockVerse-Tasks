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
### Step 8: Run the project using PHP Server 
```json
 php -S 127.0.0.1:8000 -t public
```

## Documentation 
- **Role Permission Documentation:**  
  Detailed roles and permissions with examples are available in [`ROLE-PERMISSION.md`](./ROLE-PERMISSION.md).

- **API Documentation:**  
  Complete list of API endpoints, request/response payloads, and examples are in [`API-DOCUMENTATION.md`](./API-DOCUMENTATION.md).

---

The Postman collection JSON file for testing all APIs is located in the [`Postman-json`](./Postman-json) folder.

You can import this collection into Postman to quickly test the API endpoints with pre-configured requests and payloads.

---
## Issues & Support

For any issues, bugs, or feature requests, please open an issue in the repository.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

If you have questions or want to discuss, reach me at:  
**Email:** ashaduzzaman5698@gmail.com  
**GitHub:** [github.com/Faruque5698](https://github.com/Faruque5698)

---

Thank you for reviewing this project. I look forward to your feedback!
