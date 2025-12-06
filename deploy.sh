#!/bin/bash

# Great Photo Art - Deployment Script
# This script builds and optionally deploys the Eleventy site

set -e  # Exit on error

echo "🚀 Great Photo Art - Deployment Script"
echo "========================================"
echo ""

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Clean previous build
echo "🧹 Cleaning previous build..."
rm -rf _site
echo -e "${GREEN}✓${NC} Clean complete"
echo ""

# Step 2: Build the site
echo "🏗️  Building site with Eleventy..."
npx @11ty/eleventy

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓${NC} Build successful!"
    echo ""

    # Show build stats
    echo "📊 Build Statistics:"
    echo "   HTML files: $(find _site -name "*.html" -type f | wc -l)"
    echo "   Total files: $(find _site -type f | wc -l)"
    echo "   Build size: $(du -sh _site | cut -f1)"
    echo ""

    # Ask user what to do next
    echo "What would you like to do?"
    echo "1) Test locally (start dev server)"
    echo "2) Deploy to server (requires configuration)"
    echo "3) Exit (just build)"
    read -p "Enter choice [1-3]: " choice

    case $choice in
        1)
            echo ""
            echo "🌐 Starting local development server..."
            echo "   Visit: http://localhost:8080"
            echo "   Press Ctrl+C to stop"
            echo ""
            npx @11ty/eleventy --serve
            ;;
        2)
            echo ""
            echo "📤 Deploying to server..."
            echo ""

            # Check if rsync is available
            if command -v rsync &> /dev/null; then
                echo "⚠️  Please configure deployment settings first!"
                echo ""
                echo "Edit this script and uncomment/configure one of these options:"
                echo ""
                echo "# Option 1: Deploy via rsync"
                echo "# rsync -avz --delete _site/ user@server:/path/to/www/"
                echo ""
                echo "# Option 2: Deploy via FTP"
                echo "# lftp -c \"open -u user,pass ftp.server.com; mirror -R _site/ /public_html/\""
                echo ""
                echo "# Option 3: Deploy to Netlify"
                echo "# netlify deploy --prod --dir=_site"
                echo ""

                # Uncomment and configure your deployment method here:
                # rsync -avz --delete _site/ user@greatphotoart.com:/var/www/html/

            else
                echo -e "${RED}✗${NC} rsync not found. Please install rsync or use another deployment method."
            fi
            ;;
        3)
            echo ""
            echo -e "${GREEN}✓${NC} Build complete! Files are in _site/ directory"
            echo "   You can manually upload these files to your server."
            ;;
        *)
            echo ""
            echo -e "${YELLOW}⚠${NC} Invalid choice. Build complete, files in _site/"
            ;;
    esac

else
    echo -e "${RED}✗${NC} Build failed!"
    echo "Please fix the errors above before deploying."
    exit 1
fi

echo ""
echo "========================================"
echo "Done! 🎉"

