#!/bin/bash

# ============================================
# Deployment Script for Render
# Usage: ./deploy.sh
# ============================================

set -e

echo "🚀 Starting deployment preparation..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[✓]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[!]${NC} $1"
}

print_error() {
    echo -e "${RED}[✗]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "composer.json" ]; then
    print_error "composer.json not found. Are you in the project root?"
    exit 1
fi

# Step 1: Install PHP dependencies
echo ""
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
print_status "PHP dependencies installed"

# Step 2: Generate APP_KEY if not set
echo ""
echo "🔑 Checking APP_KEY..."
if [ -z "$APP_KEY" ]; then
    print_warning "APP_KEY not set. Generating new key..."
    php artisan key:generate --show
    print_warning "Add the above APP_KEY to your .env.production file"
fi

# Step 3: Install Node dependencies
echo ""
echo "📦 Installing Node dependencies..."
npm ci --no-audit --no-fund
print_status "Node dependencies installed"

# Step 4: Build frontend assets
echo ""
echo "🔨 Building frontend assets..."
npm run build
print_status "Frontend assets built"

# Step 5: Clear caches
echo ""
echo "🧹 Clearing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_status "Caches cleared"

# Step 6: Run migrations (optional)
echo ""
echo "🗄️  Running migrations..."
read -p "Do you want to run migrations? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    print_status "Migrations completed"
else
    print_warning "Skipping migrations"
fi

echo ""
echo "========================================"
print_status "Deployment preparation complete!"
echo "========================================"
echo ""
echo "Next steps:"
echo "1. Commit changes to git: git add . && git commit -m 'Prepare for deployment'"
echo "2. Push to GitHub: git push origin main"
echo "3. Deploy on Render using the Dockerfile"
echo ""
echo "See RENDER_DEPLOYMENT.md for detailed instructions."

