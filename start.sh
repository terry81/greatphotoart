#!/bin/bash

# Quick Start Script for Great Photo Art Site
# This script helps you get started with the modernized site structure

echo "🎨 Great Photo Art - Site Setup"
echo "================================"
echo ""

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed!"
    echo ""
    echo "Please install Node.js first:"
    echo "  - Download from: https://nodejs.org/"
    echo "  - Or use Homebrew: brew install node"
    echo ""
    exit 1
fi

echo "✅ Node.js found: $(node --version)"
echo "✅ npm found: $(npm --version)"
echo ""

# Check if npm install has been run
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
    echo ""
fi

echo "🎯 What would you like to do?"
echo ""
echo "1) Start development server (auto-rebuild on changes)"
echo "2) Build site for production"
echo "3) Clean build and rebuild"
echo "4) View documentation"
echo "5) Exit"
echo ""
read -p "Choose an option (1-5): " choice

case $choice in
    1)
        echo ""
        echo "🚀 Starting development server..."
        echo "   Open your browser at: http://localhost:8080"
        echo "   Press Ctrl+C to stop"
        echo ""
        npm start
        ;;
    2)
        echo ""
        echo "🏗️  Building site..."
        npm run build
        echo ""
        echo "✅ Site built! Files are in '_site/' directory"
        echo ""
        read -p "Would you like to view the output? (y/n): " view
        if [[ $view == "y" || $view == "Y" ]]; then
            ls -lh _site/
        fi
        ;;
    3)
        echo ""
        echo "🧹 Cleaning previous build..."
        npm run clean
        echo "🏗️  Building fresh..."
        npm run build
        echo ""
        echo "✅ Clean build complete!"
        ;;
    4)
        echo ""
        echo "📚 Opening documentation..."
        if command -v open &> /dev/null; then
            open README-ELEVENTY.md
        else
            cat README-ELEVENTY.md | less
        fi
        ;;
    5)
        echo ""
        echo "👋 Goodbye!"
        exit 0
        ;;
    *)
        echo ""
        echo "❌ Invalid option. Please run the script again."
        exit 1
        ;;
esac

