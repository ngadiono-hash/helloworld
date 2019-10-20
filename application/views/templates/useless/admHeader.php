<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | <?php echo $title ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- BOOTSTRAP CSS -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
  <!-- DATATABLES CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <!-- MY CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/css_global.css">
  <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/css_admin.css"> -->
  <!-- JQUERY BOOTSTRAP -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <!-- MY SCRIPT -->
  <script src="<?= base_url(); ?>assets/js/js_global.js"></script>
  <!-- CKEDITOR -->
  <script src="<?= base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
  <script src="<?= base_url(); ?>assets/js/ckeditor/adapters/jquery.js"></script>
  <!-- DATATABLES JS -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <!-- SWEET ALERT -->
  <script src="<?= base_url(); ?>assets/js/swal/sweetalert2.all.min.js"></script>
<style>
 
/*=========== ALL =================*/
  body {
    height: 100%;
    width: 100%;
    position: relative;
    font-family: "Fredoka One", cursive;
    font-family: "Rubik", Sans-serif;
    color: #808080;
  }

  nav {
    border-radius: 0px !important;
    margin-bottom: 0px !important;
  }

  .tip + .tooltip .tooltip-inner {
    background: #f1f1f1;
    color: #808080;
    padding: 5px;
    font-size: 14px;
    border: 2px solid gray;
    font-family: 'Monda', Sans-serif;
  }
  .tip + .tooltip.bottom  .tooltip-arrow {
    border-bottom: 5px solid gray;
  }

  .inline {
    width: 100%;
    text-align: left;
    background: transparent;
    border: none;
  }

  .before-ajax {
    background: #ccc;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transition: 0.5s ease-in-out;
  }

  .before-ajax span {
    display: block;
    margin: 5px auto;
    text-align: center;
  }

  .before-ajax i {
    font-size: 6em;
  }

/*=========== SIDENAV =============*/
  .side-wrap {
    position: relative;
    height: 100%;
    background-color: silver;
  }
  .side-nav {
    position: absolute;
    top: 30px;
    left: 10px;
    display: inline-block;
    z-index: 2;
    direction: ltr;
  }
  .side-nav a {
    display: inline-block;
    width: 50px;
    max-height: 44px;
    margin: 0 !important;
    padding: 10px;
    color: #808080;
    font-family: 'Fredoka One', Sans-serif;
    position: absolute;
  }
  .side-nav a i {
    font-size: 19px;
  }
  .side-nav a span {
    /*transition: ease-in 0.5s;*/
  }
  a.satu span, a.dua span, a.tiga span, a.empat span, a.lima span, a.enam span{ position: relative; }
  .side-nav a.satu{ top: 0; }
  .side-nav a.dua{ top: 50px; }
  .side-nav a.tiga{ top: 100px; }
  .side-nav a.empat{ top: 150px; }
  .side-nav a.lima{ top: 200px; }
  .side-nav a.enam{ top: 250px; }
  /*.side-nav a.satu{ top: 300px; }*/

  a.satu:hover,a.dua:hover,a.tiga:hover,a.empat:hover,a.lima:hover,a.enam:hover,a.g:hover {
    width: 170px;
    text-shadow: none;
  }

/*=========== TABLE ===============*/

  .wrap-table {
    margin-left: 75px;
  }
  table thead tr th {
    text-transform: capitalize;
    text-align: center;
    letter-spacing: 5px !important;
    text-shadow: 1px 1px 1px #fff,
      0 0 5px blue,
      0 0 5px lightblue;
    letter-spacing: 2px;
    color: #808080;
  }
  table.dataTable thead th, table.dataTable thead td {
    padding: -1px !important;
  }
  table.dataTable thead .sorting, table.dataTable thead .sorting_asc {
    background-image: none !important;
  }

  table.dataTable tbody tr td {
    padding: 3px 5px;
    font-family: Monda, Sans-serif;
    font-weight: bold;
  }

  table.dataTable tbody tr td:hover {
    cursor: default;
  }
  table.dataTable tbody tr td a {
    color: #808080;
    text-shadow: none !important;
  }
  table.dataTable tbody tr td .btn-title,
  table.dataTable tbody tr td .btn-slug {
    text-align: left;
  }
  table.dataTable tbody tr td .input-title,
  table.dataTable tbody tr td .input-slug {
    width: 100%;
  }

  table.dataTable tbody tr:hover {
    background-color: rgb(83, 228, 102) !important;
  }
  .dataTables_length label, .dataTables_filter label {
    color: #808080 !important;
  }

  table.dataTable tbody tr td .btn-pub, 
  table.dataTable tbody tr td .btn-ready,
  table.dataTable tbody tr td .btn-pre {
    margin: 0px !important;
    padding: 5px !important;
  }

  .main-snippet {
    letter-spacing: 3px;
    margin-top: 0;
  }

  .wrap-table {
    border: 5px solid #5F5F5F;
    padding: 10px 20px;
  }

  .wrap-html {
    background: #EE8F77;
  }

  .wrap-css {
    background: #778FEE;
  }

  .wrap-js {
    background: #F7D26E;
  }
  .arrow {
    width: 50%;
  }
  .row-style {
    margin: -10px -20px 20px -20px;
    padding: 10px 15px;
    background: #f1f1f1
  }

/*=========== MAIN EDIT ===========*/
  .nav-tabs {
    font-family: 'Fredoka One', cursive;
    letter-spacing: 3px;
    background: transparent;
    z-index: 1;
  }

  .nav-tabs li a {
    border-radius: 30px !important;
    text-shadow: none !important;
    color: #808080;
    opacity: 1;
  }

  .nav-tabs li a:hover {
    border-radius: 30px !important;
    text-shadow: none !important;
  }

  .nav-tabs li.active a,
  .nav-tabs li.active a:focus,
  .nav-tabs li.active a:hover {
    border: 3px solid #5F5F5F;
    text-shadow: none !important;
    border-radius: 30px !important;
    background: #5F5F5F;
    color: #f1f1f1;
    opacity: 1;
  }

  .tab-content {
    border: 3px solid #5F5F5F;
  }

  .text-code {
    background: #e1e1e1;
    color: #333;
    margin: 5px 10px;
    padding: 20px;
    font-family: Consolas;
    overflow-y: auto;
    overflow-x: hidden;
    
    width: 98%;
    height: 439px;
    resize: none;
    font-weight: bold;
    outline: none;
    white-space: pre;
    cursor: unset;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
  }

  .icon-bar {
    position: fixed;
    top: 35%;
    right: 4px;
    direction: rtl;
  }
  .icon-bar a {
    display: inline-block;
    width: 55px;
    border-radius: 55px;
    margin: 0 !important;
    padding: 10px;
    transition: all 0.2s ease-in-out;
    color: #808080;
    font-family: 'Fredoka One', Sans-serif;
    position: absolute;
    max-height: 55px;
  }
  a.a span, a.b span, a.c span, a.d span, a.e span, a.f span, a.g span{ display: none; position: relative; }
  .icon-bar a.a{ top: 0; }
  .icon-bar a.b{ top: 50px; }
  .icon-bar a.c{ top: 100px; }
  .icon-bar a.d{ top: 150px; }
  .icon-bar a.e{ top: 200px; }
  .icon-bar a.f{ top: 250px; }
  .icon-bar a.g{ top: 300px; }

  a.a:hover,a.b:hover,a.c:hover,a.d:hover,a.e:hover,a.f:hover,a.g:hover {
    width: 150px;
  }

  #preview .modal-content {
    border: none;
  }
  #preview .modal-dialog {
    transform: translate(0%, 0%);
  }
  #preview .modal-content {
    height: 570px;
  }
  iframe {
    width: 100%;
    height: 100%;
  }
  .input-editor {
    border: 2px solid #5F5F5F;
    border-radius: 30px;
    padding: 10px 20px;
    width: 98%;
    font-size: 16px;
    font-weight: bold;
    margin: 5px;
    color: #808080;
    font-family: 'Monda', Sans-serif;
  }

  .input-editor:hover {
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  }

  .input-editor:focus {
    color: #fff;
    background: #5F5F5F;
    transition: ease-out 0.4s;
    outline: none;
  }

  .list-cat {
    padding: 10px 30px;
  }

/*=========== MOBILE ==============*/
  @media only screen and (min-width: 992px) {
    body {
      overflow: hidden;
    }

  @media (min-width: 768px) {
    #preview .modal-dialog {
      /*max-width: 922px;*/
      width: auto;
      min-width: 768px;
    }
  }

</style>

</head>
<body>
<?php loader(); ?>

<div class="side-wrap">
  <div class="side-nav">
    <a class="satu button btn-def" href="<?= base_url(); ?>" target="_blank">  <i class="fa fa-eye"></i> <span>Visit Site</span></a>
    <a class="dua button btn-prm" href="<?= base_url(); ?>admin/home"> <i class="fa fa-home"></i> <span>Home</span></a>
    <a class="tiga button btn-html" href="<?= base_url(); ?>admin/html"> <i class="fab fa-html5 fa-lg"></i> <span>Snippet HTML</span></a>
    <a class="empat button btn-css" href="<?= base_url(); ?>admin/css"> <i class="fab fa-css3-alt fa-lg"></i> <span>Snippet CSS</span></a>
    <a class="lima button btn-js" href="<?= base_url(); ?>admin/js"> <i class="fab fa-js-square fa-lg"></i> <span>Snippet JS</span></a>
    <a class="enam button btn-no" href="<?= base_url(); ?>"> <i class="fa fa-sign-out-alt"></i> <span>Log Out</span></a>
  </div>
</div>




<main>