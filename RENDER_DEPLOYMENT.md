# Render Deployment Guide for Laravel + React (Inertia)

## ✅ **No Bank Card Required - Free Tier**

This guide will help you deploy your Laravel + React (Inertia) project on Render for free.

---

## 📋 Prerequisites

1. **GitHub Account** - You'll need to push your code to GitHub
2. **Render Account** - Sign up at [render.com](https://render.com) (no credit card required)

---

## 🚀 Step 1: Prepare Your Project

### 1.1 Update Environment Variables

Create a `.env.production` file in your project root:

```env
APP_NAME="Pyinnyar Pankhin"
APP_ENV=production
APP_KEY=base64:Rl1kkZGCOJVgFKMWpAJMYHBhCmZzVPfFKPxqS8S0OVU=
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

# Database (Render provides PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=/cloudsql/YOUR_CONNECTION_NAME
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Or use SQLite for free tier (data won't persist on free tier)
# DB_CONNECTION=sqlite
# DB_DATABASE=/tmp/database.sqlite

LOG_CHANNEL=stderr
```

### 1.2 Update vite.config.ts

Remove SSR configuration since we're using traditional server-side rendering:

```typescript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
});
```

---

## 📤 Step 2: Push to GitHub

```bash
# Initialize git if not already initialized
git init
git add .
git commit -m "Prepare for Render deployment"

# Create GitHub repository and push
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git branch -M main
git push -u origin main
```

---

## 🖥️ Step 3: Deploy on Render

### 3.1 Create a Web Service

1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click **"New +"** → **"Web Service"**
3. Connect your GitHub repository
4. Configure the service:

| Setting | Value |
|---------|-------|
| **Name** | `laravel-app` |
| **Region** | Oregon (US West) or Frankfurt (EU) |
| **Branch** | `main` |
| **Runtime** | `Docker` |
| **Build Command** | (leave empty - Dockerfile handles it) |
| **Start Command** | (leave empty - Dockerfile handles it) |

### 3.2 Environment Variables

In the Render dashboard, add these environment variables:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:Rl1kkZGCOJVgFKMWpAJMYHBhCmZzVPfFKPxqS8S0OVU=
# Generate a new key: php artisan key:generate --show

# If using PostgreSQL (recommended)
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# If using SQLite (no setup needed, but data won't persist on free tier)
# DB_CONNECTION=sqlite
# DB_DATABASE=/tmp/database.sqlite
```

### 3.3 Create Database (Optional but Recommended)

1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click **"New +"** → **"PostgreSQL"**
3. Configure:
   - **Name**: `laravel-db`
   - **Plan**: Free
   - **Region**: Same as your web service
4. Click **"Create Database"**
5. Once created, copy the "Internal Database URL"
6. Add to your web service environment variables:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=your-internal-db-url
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

### 3.4 Deploy

1. Click **"Create Web Service"**
2. Wait for build to complete (5-10 minutes on first deploy)
3. Check logs for any errors

---

## 🔧 Step 4: Run Migrations

### Option 1: Via Render Shell

1. Go to your web service in Render Dashboard
2. Click **"Shell"** tab
3. Run:
   ```bash
   php artisan migrate --force
   ```

### Option 2: Via Command Line

1. Install Render CLI:
   ```bash
   npm install -g render-cli
   render login
   ```

2. Run migrations:
   ```bash
   render run --service=laravel-app -- php artisan migrate --force
   ```

---

## ✅ Step 5: Verify Deployment

1. Click the **"URL"** link in your Render dashboard
2. You should see your Laravel application
3. Test:
   - Homepage loads correctly
   - Navigation works
   - Admin panel accessible

---

## 📦 Additional Setup

### Storage (File Uploads)

Render doesn't persist files between deployments. For file uploads:

1. **Use External Storage**:
   - AWS S3
   - Cloudinary
   - Uploadcare

2. **Configure in .env**:
   ```env
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=your-key
   AWS_SECRET_ACCESS_KEY=your-secret
   AWS_REGION=us-east-1
   AWS_BUCKET=your-bucket
   ```

### Queue Workers (If Needed)

For background jobs:

1. Create a **Background Worker** service on Render
2. Start Command:
   ```bash
   php artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
   ```

### Scheduled Tasks (Cron)

For scheduled tasks:

1. Create a **Cron Job** service on Render
2. Schedule:
   ```bash
   * * * * * php /app/artisan schedule:run >> /dev/null 2>&1
   ```

---

## 🔒 Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Generate strong `APP_KEY`
- [ ] Use HTTPS (Render provides SSL automatically)
- [ ] Configure CORS if needed
- [ ] Set up database credentials (don't commit .env)

---

## 💰 Free Tier Limitations

| Resource | Limit |
|----------|-------|
| **Build Time** | 500 minutes/month |
| **Web Service** | 750 hours/month |
| **PostgreSQL** | 1 database, 256MB storage |
| **Bandwidth** | 100GB/month |
| **Sleep** | Service sleeps after 15 min inactivity |

**Note**: Services on free tier go to sleep after 15 minutes of inactivity. They'll wake up when accessed, but may take ~30 seconds.

---

## 🐛 Troubleshooting

### Build Fails
- Check Build Logs in Render Dashboard
- Ensure `Dockerfile` is in root directory
- Verify all dependencies in `composer.json` and `package.json`

### 500 Error
- Check Application Logs in Render Dashboard
- Run migrations: `php artisan migrate --force`
- Verify environment variables

### Static Assets Not Loading
- Ensure `npm run build` completed successfully
- Check `public/build` directory exists
- Verify nginx configuration in `Dockerfile`

### Database Connection Issues
- Verify database credentials in environment variables
- Check if database and web service are in same region
- Ensure database is fully provisioned before deploying web service

---

## 📚 Useful Commands

```bash
# Generate APP_KEY
php artisan key:generate --show

# Clear all caches
php artisan optimize:clear

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Rollback migrations
php artisan migrate:rollback --force
```

---

## 🎯 Quick Summary

1. ✅ Push code to GitHub
2. ✅ Create Render Web Service with Docker
3. ✅ Configure environment variables
4. ✅ (Optional) Create PostgreSQL database
5. ✅ Run migrations
6. ✅ Deploy and test!

---

**Need help?** Check [Render Documentation](https://render.com/docs) or open an issue on GitHub.

