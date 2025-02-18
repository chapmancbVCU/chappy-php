<h1 style="font-size: 50px; text-align: center;">User Guide Setup</h1>

This guide explains how to set up **Jekyll** to serve the PHP MVC framework's user guide both **locally** and on **GitHub Pages**, ensuring compatibility with GitHub’s environment.

---

## 1. Install Ruby and Jekyll

Jekyll requires Ruby. Follow the steps based on your operating system:

### MacOS/Linux
```sh
gem install bundler jekyll
```

### Windows
1. Install **Ruby** from [RubyInstaller](https://rubyinstaller.org/).
2. Open a terminal (Git Bash or Command Prompt with Ruby) and run:
   ```sh
   gem install bundler jekyll
   ```

---

## 2. Navigate to the `docs/` Directory

Since the user guide is stored in `docs/` at the project root, navigate to that directory:
```sh
cd path/to/your/project/docs
```

---

## 3. Create or Update the `Gemfile`

The `Gemfile` manages Jekyll dependencies. Ensure it contains:

```ruby
source "https://rubygems.org"

# Use the GitHub Pages gem, which includes Jekyll
gem "github-pages", group: :jekyll_plugins

# Minima is included with GitHub Pages, so you don't need to specify a version.
gem "minima"

group :jekyll_plugins do
  gem "jekyll-feed", "~> 0.12"
end

# Windows and JRuby fixes
platforms :mingw, :x64_mingw, :mswin, :jruby do
  gem "tzinfo", ">= 1", "< 3"
  gem "tzinfo-data"
end

gem "wdm", "~> 0.1", platforms: [:mingw, :x64_mingw, :mswin]
gem "http_parser.rb", "~> 0.6.0", platforms: [:jruby]
```

### Why this works:
- It **removes direct Jekyll installation** (`gem "jekyll"`) since GitHub Pages manages Jekyll automatically.
- It **ensures compatibility with GitHub Pages** by using `github-pages`.
- It **keeps Minima included** without forcing a specific version.

---

## 4. Install Dependencies

Before installing, remove any old dependencies:
```sh
rm -rf Gemfile.lock
```

Now install the correct versions:
```sh
bundle install
```

---

## 5. Configure `_config.yml`

Modify `docs/_config.yml` to ensure the correct setup:

```yaml
title: "My PHP MVC Framework Guide"
description: "User guide for my custom PHP MVC framework."
theme: minima
baseurl: "/your-repo-name" # Set to "" if this is a user/org site
url: "https://yourusername.github.io"

# Ensure Jekyll serves Markdown files
include:
  - "*.md"

# Set up assets folder
sass:
  sass_dir: "assets/css"

# Exclude unnecessary files
exclude:
  - "Gemfile"
  - "Gemfile.lock"
  - "README.md"
  - "vendor"
  - "node_modules"
```

### Base URL Considerations:
- **For user/org sites (`yourusername.github.io`)**, set:
  ```yaml
  baseurl: ""
  ```
- **For project sites (`yourusername.github.io/your-repo-name`)**, set:
  ```yaml
  baseurl: "/your-repo-name"
  ```

---

## 6. Serve Jekyll Locally

To preview the guide locally from within the docs directory:
```sh
bundle exec jekyll serve --livereload
```
or under project root:
```sh
php console serve:docs
```


Then open:
- **For project sites:** `http://localhost:4000/your-repo-name/`
- **For user/org sites:** `http://localhost:4000/`

---

## 7. Commit and Push to GitHub

Once everything looks good, commit and push the changes:
```sh
git add .
git commit -m "Set up Jekyll for framework guide"
git push origin main
```

---

## 8. Enable GitHub Pages

1. Go to your repository on **GitHub**.
2. Navigate to **Settings > Pages**.
3. Under **Source**, select:
   - `GitHub Actions` **(recommended)**
   - OR `GitHub Pages` with the `main` branch and `/docs` folder.
4. Click **Save**.

Your site will be available at:
- `https://yourusername.github.io/your-repo-name/`
- OR `https://yourusername.github.io/` (for user/org sites).

---

## 9. Verify Deployment

After a few minutes, visit:
- **For project pages:** `https://yourusername.github.io/your-repo-name/`
- **For user/org pages:** `https://yourusername.github.io/`

To check for issues:
```sh
bundle exec github-pages health-check
```

---

## 10. (Optional) Custom Domain

If using a custom domain:

1. Add a `CNAME` file inside `docs/` containing your domain.
2. Update **DNS settings** to point to GitHub’s IPs.
3. Enable **HTTPS** in **GitHub Pages settings**.

## 11. Troubleshooting
In my particular case I had to export gems using the following commands:
```sh
echo 'export GEM_HOME=$HOME/gems' >> ~/.bashrc
echo 'export PATH="$HOME/gems/bin:$PATH"' >> ~/.bashrc
source ~/.bashrc
```