<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
  <p><em>Note: MIKE UNLOCKED THE WRONG EXAM AND THEN SENT ME THIS ONE - Pokes :)</em></p>
<?php echo validation_errors(); ?>

<p><?php
  if($this->session->flashdata('loggin_error')) {
  echo $this->session->flashdata('loggin_error');
}
  if($this->session->flashdata('registration_error')) {
  echo $this->session->flashdata('registration_error');
}
?>
<h1>Welcome!</h1>
  <form class="pure-form pure-form-aligned" action="register" method="post">
        <legend>Register</legend>
        <div class="pure-control-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name">
        </div>
        <div class="pure-control-group">
            <label for="alias">Alias</label>
            <input type="text" name="alias" placeholder="Alias">
        </div>
        <div class="pure-control-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="email" required>
        </div>
        <div class="pure-control-group">
            <span style="color:red; font-size:0.8em; margin-left:15%;">*Password must be at least 6 characters</span><br>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="pure-control-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        <div class="pure-control-group">
            <label for="dob">Date of birth</label>
            <input type="date" name="dob">
        </div>
            <button type="submit" class="pure-button pure-button-primary" value="register">Register</button>
      </form>
<?php
if($this->session->flashdata('login_error')) {
echo $this->session->flashdata('login_error');
} ?>

<form class="pure-form pure-form-aligned" action="login" method="post">
    <legend>Log In</legend>
  <div class="pure-control-group">
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="email" required>
  </div>
  <div class="pure-control-group">
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" required>
  </div>
        <button type="submit" class="pure-button pure-button-primary" value="login">Login</button>
</form>
</body>
</html>
