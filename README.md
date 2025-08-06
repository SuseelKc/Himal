# Himal Gyawaly - Multimedia Portfolio

A beautiful and modern multimedia portfolio website built with Laravel, showcasing 3D artwork, images, and videos with a professional CMS for content management.

## 🎨 Features

- **Modern UI/UX**: Beautiful, responsive design with Tailwind CSS
- **Multimedia Support**: Upload and display images (max 20MB, 1920x1080) and videos (max 200MB)
- **Content Management**: Full CMS with authentication for managing portfolio content
- **Public Portfolio**: Attractive public-facing portfolio page
- **File Validation**: Comprehensive file type and size validation
- **Admin Authentication**: Secure login system with seeded admin user

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd himal-portfolio
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=himal_portfolio
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 👤 Admin Access

The application comes with a pre-seeded admin user:

- **Email**: `admin@123`
- **Password**: `admin@123`

Visit `/login` to access the admin panel.

## 📁 Project Structure

```
himal-portfolio/
├── app/
│   ├── Http/Controllers/
│   │   └── MultimediaController.php    # Handles multimedia CRUD operations
│   └── Models/
│       └── Multimedia.php              # Multimedia model
├── database/
│   ├── migrations/
│   │   └── create_multimedia_table.php # Database schema
│   └── seeders/
│       └── AdminUserSeeder.php         # Admin user seeder
├── resources/
│   └── views/
│       ├── portfolio.blade.php         # Public portfolio page
│       └── multimedia/                 # CMS views
│           ├── index.blade.php         # Content management
│           ├── create.blade.php        # Upload form
│           └── edit.blade.php          # Edit form
└── routes/
    └── web.php                         # Application routes
```

## 🎯 Usage

### Public Portfolio
- Visit the homepage to see the public portfolio
- Displays uploaded images and videos in an attractive grid layout
- Features a hero section with artist information
- Includes an about section with skills and expertise

### Admin Panel
1. **Login**: Use the admin credentials to access the CMS
2. **Dashboard**: Overview of portfolio management features
3. **Upload Content**: Add new images or videos with titles and descriptions
4. **Manage Content**: Edit or delete existing multimedia files
5. **View Portfolio**: Preview the public-facing portfolio

### File Upload Guidelines

#### Images
- **Supported formats**: JPG, JPEG, PNG, WebP
- **Maximum size**: 20MB
- **Maximum resolution**: 1920x1080 pixels
- **Recommended**: High-quality 3D renders and artwork

#### Videos
- **Supported formats**: MP4, MOV, AVI, WebM
- **Maximum size**: 200MB
- **Recommended**: Demo reels, walkthroughs, and 3D animations

## 🛠️ Technical Details

### Database Schema
```sql
multimedia table:
- id (primary key)
- title (string)
- description (text, nullable)
- file_path (string)
- type (enum: 'image', 'video')
- timestamps
```

### Key Technologies
- **Backend**: Laravel 10.x
- **Frontend**: Tailwind CSS, Alpine.js
- **Authentication**: Laravel Breeze
- **File Processing**: Intervention Image
- **Database**: MySQL/PostgreSQL

### Security Features
- CSRF protection
- File type validation
- File size limits
- Secure file storage
- Authentication middleware

## 🎨 Customization

### Styling
- Edit `resources/views/portfolio.blade.php` for public page styling
- Modify `resources/views/multimedia/` files for admin panel styling
- Update `tailwind.config.js` for custom design system

### Content
- Update artist information in portfolio view
- Modify skills and expertise sections
- Customize color scheme and branding

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions, please contact the development team.

---

**Built with ❤️ using Laravel and Tailwind CSS**
