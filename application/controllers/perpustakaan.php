<?php
class Perpustakaan extends CI_Controller{

  function __construct(){
    parent::__construct();
    // ini harusnya di load di autoload.php
    // $this->load->library(array('template','pagination','form_validation','upload'));
    $this->load->model('m_anggota');
  }

  function index(){
    echo "hello world, cubi endud";
  }
}
