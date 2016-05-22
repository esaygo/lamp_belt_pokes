<?php

class User extends CI_Model {
  function add_user($new_user) {
      $query = 'INSERT INTO users (name,alias, email, password, dob, created_at,updated_at) VALUES (?,?,?,?,?,NOW(),NOW())';
      $values = array($new_user['name'], $new_user['alias'], $new_user['email'], $new_user['password'], $new_user['dob']);
      return $this->db->query($query, $values);
  }
  function get_user($new_user) {
      $query = "SELECT * FROM users WHERE email = ?";
      $user_info = $this->db->query($query,$new_user['email'])->row_array();
      return $user_info;
    }
  function get_user_login($existing_user) {
    $query = "SELECT * FROM users WHERE email = ? AND password = ? ";
    $values = array($existing_user['email'], $existing_user['password']);
    $user_info = $this->db->query($query, $values)->row_array();
    return $user_info;
}
  function get_user_pokes() {
    $loggedin_user = $this->session->userdata('login_info');
    $query = "SELECT users.name AS poker, COUNT(users.id) AS pokes_count, users2.name AS poked
    FROM users LEFT JOIN pokes
    ON users.id = pokes.poker_id
    LEFT JOIN users AS users2
    ON users2.id = pokes.poked_id
    WHERE users2.id = ? GROUP BY poker DESC";
    $values = array($loggedin_user['id']);
    $user_pokes = $this->db->query($query, $values)->result_array();
    return $user_pokes;
  }
  function get_user_total_pokes() {
    $loggedin_user = $this->session->userdata('login_info');
    $query = "SELECT COUNT(poked) AS total_pokes FROM (
    SELECT users.name AS poker, users2.name AS poked
    FROM users LEFT JOIN pokes
    ON users.id = pokes.poker_id
    LEFT JOIN users AS users2
    ON users2.id = pokes.poked_id
    WHERE users2.id = ? GROUP BY poker)as table1";
    $values = array($loggedin_user['id']);
    $user_total_pokes = $this->db->query($query, $values)->row_array();
    return $user_total_pokes;
  }
  function get_other_users_pokes() {
    $loggedin_user = $this->session->userdata('login_info');
    $query = "SELECT users.id AS poked_id,users.name AS poked, users.alias AS poked_alias, users.email AS poked_email, users2.name as poker, COUNT(users2.id) AS pokes_count
    FROM users LEFT JOIN pokes
    ON users.id = pokes.poked_id
    LEFT JOIN users as users2
    ON users2.id = pokes.poker_id
    WHERE users.id != ? GROUP BY poked";
    $values = array($loggedin_user['id']);
    $other_users_pokes = $this->db->query($query, $values)->result_array();
    return $other_users_pokes;
  }
  function add_pokes($poked_id) {
    $loggedin_user = $this->session->userdata('login_info');
    $query = 'INSERT INTO pokes (poker_id, poked_id, created_at,updated_at) VALUES (?,?,NOW(),NOW())';
    $values = array($loggedin_user['id'], $poked_id);
    return $this->db->query($query, $values);
  }
}
?>
