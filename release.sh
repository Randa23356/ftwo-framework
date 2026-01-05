#!/bin/bash

# FTwoDev Framework Release Script
# Usage: ./release.sh [version]

set -e

VERSION=${1:-"1.5.0"}

echo "🚀 Releasing FTwoDev Framework v$VERSION"

# 1. Update version in files
echo "📝 Updating version numbers..."

# Update composer.json
sed -i '' "s/\"version\": \".*\"/\"version\": \"$VERSION\"/" composer.json

# Update Boot.php
sed -i '' "s/const VERSION = '.*'/const VERSION = '$VERSION'/" engine/Boot.php

# 2. Run tests
echo "🧪 Running tests..."
php ftwo ignite:refresh

# 3. Validate composer
echo "✅ Validating composer..."
composer validate --strict

# 4. Add all changes
echo "📦 Committing changes..."
git add .
git commit -m "Release v$VERSION - ORM & Validation System"

# 5. Create tag
echo "🏷️ Creating tag..."
git tag -a "v$VERSION" -m "Release v$VERSION

🚀 Major Features:
- Complete ORM Enhancement with QueryBuilder & Relationships
- Powerful Validation System with 25+ built-in rules
- Enhanced Bloom Auth with ORM integration
- Performance improvements and bug fixes"

# 6. Push to GitHub
echo "📤 Pushing to GitHub..."
git push origin main
git push origin "v$VERSION"

echo "✅ Release v$VERSION completed!"
echo "🌐 Check Packagist for update: https://packagist.org/packages/ftwodev/framework"
