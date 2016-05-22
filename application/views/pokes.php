<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pokes</title>
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <style>
  * {
    margin-left: 10px;
  }

  a {
    color: #000;
  }
  #poke {
    border: 1px solid grey;
    padding: 5px;
    background-color: rgb(227, 230, 232);
  }
    table {
      margin-bottom: 30px;
      margin-left: 10px;
      text-align: center;
    }
    table th, td {
        padding: 10px;
    }
    .pure-menu-link {
      margin-left: 50%;
    }

  </style>
</head>
  <body>
 <!-- var_dump($user_pokes); die();
 var_dump($other_users_pokes); die(); -->
 <div class="pure-menu pure-menu-horizontal">
  <a class="pure-menu-heading pure-menu-link" href="/logout">Logout</a>
 </div>
  <h3>Hello, <?= $info['name'];?></h3>
  <p><?= $user_total_pokes['total_pokes']; ?> people poked you!</p>
  <div id="pokes_summary">
    <ul>
      <?php foreach ($user_pokes as $poke) { ?>
      <li><?= $poke['poker'] ?> poked you <?= $poke['pokes_count']; ?> times.</li>
    <?php } ?>
    </ul>
  </div>
  <p>People you may want to poke:</p>
  <table border="1">
    <thead>
      <th>Name</th>
      <th>Alias</th>
      <th>Email address</th>
      <th>Poke History</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php foreach ($other_users_pokes as $poke) { ?>
      <tr>
        <td><?= $poke['poked']; ?></td>
        <td><?= $poke['poked_alias']; ?></td>
        <td><?= $poke['poked_email']; ?></td>
        <td><?= $poke['pokes_count']; ?></td>
        <!-- add to pokes the user's id from session and the poked id -->
        <td><a id="poke" href="/add_poke/<?= $poke['poked_id']; ?>">Poke</a></td>

      </tr>
<?php } ?>
      </tbody>
    </table>
  </body>
</html>
