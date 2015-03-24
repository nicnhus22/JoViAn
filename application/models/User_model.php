  <?php
  class User_model extends CI_Model {

  public $id;
  public $email;
  public $salt;
  public $password_hash;
  public $first_name;
  public $last_name;
  public $age;
  public $gender;

  private $table = 'users';
  private $properties = array('email', 'salt', 'password_hash', 'first_name', 'last_name', 'age', 'gender');

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function auth($email, $password) {
    $user = $this->db->where('email', $email)
        ->order_by("id", "ASC")
        ->limit(1)
        ->get($this->table)
        ->row();

    if (!$user) {
      return false;
    }
    $password_hash = hash('sha256', $user->salt . $password);
    return $user->password_hash == $password_hash ? $user : FALSE;
  }

  public function get($id)
  {
    $query = $this->db->get('users', 10);
    return $query->result();
  }

  public function insert($data)
  {
    foreach ($this->properties as $property) {
      if (isset($data[$property])) {
        $this->{$property} = $data[$property];
      }
    }

    if (empty($this->salt)) {
      $length = 15;
      $this->salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
    $this->password_hash = hash('sha256', $this->salt . $data['password']);

    $this->db->insert('users', $this);
    return $this->db->insert_id();
  }

  public function update($id, $data)
  {
    foreach ($this->properties as $property) {
      if (isset($data[$property])) {
        $this->{$property} = $data[$property];
      }
    }

    $this->db->update('users', $this, array('id' => $id));
  }

}