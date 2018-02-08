 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Humanrex extends CI_Model{

  public function __construct()
  {
      parent::__construct();
  }

  public function fetch_temp_entry()
      {
          $query = $this->db->get('temp_entry');
          return $query->result();
      }
 ?>
