<?php use Core\Lib\Utilities\Env; ?>
<?php $this->start('body'); ?>

<div class="container">
  <div class="text-center">
    <h1 class="display-4">Welcome to</h1>
    <div class="col-12 mx-auto text-center">
      <img class="w-50" src="<?=Env::get('APP_DOMAIN', '/')?>public/logo.png" alt="Framework Logo">
    </div>
    <p class="lead mt-3">
      A lightweight and modern PHP framework built for simplicity, speed, and developer happiness.
    </p>

    <div class="d-flex justify-content-center mt-4 flex-wrap gap-3">
      <a class="btn btn-primary" href="https://chapmancbvcu.github.io/chappy-php/">📘 View Documentation</a>
      <a class="btn btn-outline-secondary" href="<?= Env::get('APP_DOMAIN', '/') ?>contacts">🚀 Sample App</a>
    </div>
  </div>

  <hr class="my-5">

  <div class="row text-center g-4">
    <div class="col-md-4">
      <h4>🔧 MVC Architecture</h4>
      <p>Familiar routing and controller setup with simple view rendering.</p>
    </div>
    <div class="col-md-4">
      <h4>🛡️ Custom Forms With Validation</h4>
      <p>A FormHelper class with support for many commonly used elements and built-in server-side form validation with error message support.</p>
    </div>
    <div class="col-md-4">
      <h4>⚙️ Project Generator</h4>
      <p>Generate project skeletons and database migrations using console commands.</p>
    </div>
  </div>

  <div class="row text-center g-4 mt-4">
    <div class="col-md-4">
      <h4>🧩 Composer Support</h4>
      <p>Manage your dependencies using Composer just like Laravel or Symfony.</p>
    </div>
    <div class="col-md-4">
      <h4>📁 User Management</h4>
      <p>Includes ACL support and authentication out of the box.</p>
    </div>
    <div class="col-md-4">
      <h4>📄 Simple Documentation</h4>
      <p>Markdown and API documentation included and easy to customize.</p>
    </div>
  </div>

  <hr class="my-5">

  <div class="row justify-content-center my-5">
    <div class="col-12 col-md-10">
      <h2 class="text-center mb-4">Key Features of Chappy.php</h2>
      <ul class="list-group shadow-sm">
        <li class="list-group-item">
          <strong>Dynamic Routing & Request Handling:</strong> Map clean URLs to controllers without needing to define routes manually.
        </li>
        <li class="list-group-item">
          <strong>CLI Powered by Symfony:</strong> Run migrations, seed data, or clear logs using our integrated console commands.
        </li>
        <li class="list-group-item">
          <strong>Validation and Flash Messaging:</strong> Easily validate input and notify users with helpful UI feedback.
        </li>
        <li class="list-group-item">
          <strong>Secure User Management:</strong> Includes registration, login, password hashing, sessions, and an admin role.
        </li>
        <li class="list-group-item">
          <strong>Layouts & Components:</strong> Build dynamic pages with reusable layout and UI parts.
        </li>
        <li class="list-group-item">
          <strong>Strong Security:</strong> Built-in CSRF protection, input sanitization, and request filtering.
        </li>
        <li class="list-group-item">
          <strong>Single & Multiple File Uploads:</strong> Includes MIME checking and secure file naming strategies.
        </li>
        <li class="list-group-item">
          <strong>Developer Tools:</strong> Debug mode, log viewer, unit test support, and database seeders.
        </li>
        <li class="list-group-item">
          <strong>Built-In Documentation:</strong> Full API docs via Doctum and user guide with Jekyll or Daux.io support.
        </li>
        <li class="list-group-item">
          <strong>Vite for Asset Bundling:</strong> Modern frontend pipeline with support for ES modules, SCSS, and more.
        </li>
        <li class="list-group-item">
          <strong>Pagination and Migrations:</strong> Easy-to-implement pagination system and robust migration structure.
        </li>
        <li class="list-group-item">
          <strong>Contact Manager App Included:</strong> A pre-built sample app to demonstrate best practices and features.
        </li>
      </ul>
    </div>
  </div>

  <hr class="my-5">

  <div class="text-center">
    <h4>⚡ Ajax In Action</h4>
    <p>Test a sample Ajax call to see the framework response.</p>
    <button class="btn btn-success" onclick="ajaxTest();">Run Ajax Test</button>
  </div>

  <script>
    function ajaxTest() {
      $.ajax({
        type: "POST",
        url: "<?= Env::get('APP_DOMAIN', '/') ?>home/testAjax",
        data: { model_id: 45 },
        success: function (resp) {
          if (resp.success) {
            alert("Server says: " + resp.data.name);
          }
          console.log(resp);
        }
      });
    }
  </script>

  <p class="text-center text-muted mt-5">
    To customize this page, edit <code>resources/views/home/index.php</code> and <code>app/Controllers/HomeController.php</code>.
  </p>
</div>

<?php $this->end(); ?>
