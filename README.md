# Blog CMS

A modern, full-featured Blog Content Management System built with **Laravel 12**, **Tailwind CSS**, and **Alpine.js**. This application provides a robust platform for publishing content, managing users, and fostering community interaction.

![Dashboard Preview](docs/screenshot/dashboard.png)

## 🚀 Key Features

*   **User Authentication & Roles**
    *   Secure registration and login system (Laravel Breeze).
    *   **Admin Dashboard**: Dedicated area for content and user management.
    *   **Role-Based Access Control**: Distinguish between standard users and administrators.
*   **Content Management**
    *   **Rich Text Posts**: Create and edit blog posts with ease.
    *   **Categories**: Organize posts into manageable categories.
*   **Community Interaction**
    *   **Comments System**: Users can engage with content via comments.
    *   **Notifications**: Real-time alerts for user interactions.
*   **Modern UI/UX**
    *   **Responsive Design**: Mobile-first architecture using Tailwind CSS.
    *   **Interactive Elements**: Powered by Alpine.js for a smooth user experience.

## 🛠️ Technology Stack

*   **Backend**: [Laravel 12](https://laravel.com)
*   **Frontend**: [Blade Templates](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
*   **Build Tool**: [Vite](https://vitejs.dev)
*   **Database**: SQLite

## 📸 Screenshots

| Post View | User Management |
|:---:|:---:|
| ![Post View](docs/screenshot/post_view.png) | ![User Management Page](docs/screenshot/user_management.png) |

## 🏁 Getting Started

### Prerequisites

*   PHP >= 8.2
*   Composer
*   Node.js & NPM

### Local Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/sgimres/blog-cms.git
    cd blog-cms
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database Setup**
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```
    *Note: The seeder creates a default Admin user and sample posts.*

6.  **Run the Application**
    ```bash
    ```
    composer run dev
    Visit `http://localhost:8000` in your browser.


## 🧪 Running Tests

Ensure your code is stable and bug-free by running the test suite.

```bash
php artisan test
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
