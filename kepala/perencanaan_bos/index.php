<?php
// require('../url.php');
require('../../url.php');
require('../../model/crud.php');
$crud = new Crud;
$standar = $crud->read_data('tbl_standar_nasional');
$pendapatan_belanja = $crud->pendapatan_belanja();
require('../../view/tata_usaha/perencanaan_bos.php');
