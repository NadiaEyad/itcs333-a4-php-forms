<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — contact form.
 * Requirements (see README rubric):
 *   - GET: render the form
 *   - POST: validate name (required, 2-60 chars), email (valid), message (required, 10-1000 chars)
 *   - invalid POST: re-render with inline errors + repopulated fields (200)
 *   - valid POST: redirect (302/303) to a success page (PRG)
 *   - escape all output with htmlspecialchars
 */

require_once __DIR__ . '/../src/validate.php';

// TODO: implement the form handling here.
  $name = '';
  $email = '';
  $message = '';
  $errors = [];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if(!validate_required($name)){
      $errors['name'] = 'Name is required';
    }
    elseif(!validate_length($name, 2, 60)){
      $errors['name'] = 'Name must be 2-60 characters';
    }

    if(!validate_email($email)){
      $errors['email'] = 'Enter a valid email';
    }

    if(!validate_required($message)){
      $errors['message'] = 'Message is required';
    }
    elseif(!validate_length($message, 10, 1000)){
      $errors['message'] = 'Message must be 10-1000 characters';
    }

    if($errors == []){
      header('Location: index.php?sent=1', true, 303);
      exit;
    }
  }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <!-- TODO: render the form, inline errors, and repopulated values -->
  <?php
   if (isset($_GET['sent']) && $_GET['sent'] === '1') {
    echo '<p>Form submitted successfully.</p>';
    }
    ?>

  <form method="post" action="index.php">
    <label>Name <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"></label><br>

    <?php if(isset($errors['name'])){
      echo htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8');
    }
    ?>

    <br>

    <label>Email <input type="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"></label><br>

    <?php if(isset($errors['email'])){
      echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8');
    }
    ?>

    <br>

    <label>Message <textarea name="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></textarea></label><br>

    <?php if(isset($errors['message'])){
      echo htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8');
    }
    ?>

    <button type="submit">Send</button>
  </form>
</body>
</html>
