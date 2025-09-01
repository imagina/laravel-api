# 🚀 Laravel Wrapper

This project is a **Laravel wrapper** that comes with preconfigured setup and utilities, including:

- **Passport** authentication preconfigured.
- **Laravel Modules** for modular architecture.
- Custom configuration files centralized in `config/`.
- Installation script (`php artisan imagina:setup`) for first-time setup.
- Ready-to-use Docker environment with support for **PHP-FPM** and **Laravel Octane**.
- Integrated services: **Nginx**, **MySQL**, **Memcached**.

---

## 🐳 Build Docker (Optional)

This project includes a Docker environment ready for development.

1. Build and start containers

```bash
docker-compose up -d --build
```

This will start:

- **nginx** → Web server (http://localhost:8081)
- **mysql** → Database (port 3307)
- **memcached** → Cache
- **laravel_api_fpm** → PHP-FPM container (for development)
- **laravel_api_octane** → Laravel Octane container (for performance testing)

2. Bash
   Recommended for daily development with hot-reloading:
   ```bash
   docker exec -it laravel_api_fpm bash
   ```
   
---

## 📦 Installation

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Run the setup command:
   ```bash
   php artisan imagina:setup
   ```

- `all` → runs the full setup in one go (DB, S3, Passport, modules, etc.)
- Or choose to run specific setups:

3. Create Access User
   ```bash
   php artisan iuser:create-user
   ```

---

## 📝 Notes

- The `php artisan imagina:setup` command handles both the initial configuration and the installation of modules (no
  need to install them manually).
- You can choose between **PHP-FPM** or **Octane** depending on your workflow:
- FPM for everyday development with code changes applied instantly.
- Octane for testing performance and compatibility.

---

## 📜 Useful Commands

- **Restart services**
  ```bash
  docker-compose restart
  ```
- **Enter PHP-FPM container**
  ```bash
  docker exec -it laravel_api_fpm bash
  ```
- **Enter Octane container**
  ```bash
  docker exec -it laravel_api_octane bash
  ```
