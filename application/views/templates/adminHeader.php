<?php
reload_session();
// bug($_SESSION);
$lessonTable = whats_page(2,['less']);
$quizTable = whats_page(2,['quiz']);
$editPage = whats_page(2,['editor']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $title; ?></title>
<meta name="csrf" content="<?= $this->security->get_csrf_hash(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?=log?>roboto.css">
<link rel="stylesheet" href="<?=log?>all.min.css">
<link rel="stylesheet" href="<?=log?>bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/sb-admin/sb-admin-2.min.css">
<?php myGlobalCss() ?>
<?php if ($quizTable) {
// echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">';
echo '<link rel="stylesheet" href="'.log.'select-bootstrap.min.css">';
} ?>
<?php if ($lessonTable) {
// echo '<link rel="stylesheet" href="https://cdn.datatables.net/v/ju-1.12.1/rr-1.2.4/datatables.min.css">';
echo '<link rel="stylesheet" href="'.log.'datatable.min.css">';
} ?>
<link rel="stylesheet" href="<?=log?>jquery-ui.css">
<style type="text/css">
.wrapper-editor .splitter, .content-editor .splitter { 
	background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
}

.content-edit {
  position: fixed;
  z-index: 9;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  transition: border 0.7s ease;
}
.content-edit.changed {
  border: 5px inset red;
}
.content-editor {
  display: flex;
  flex-direction: row;
  overflow: hidden;
  height: 100%;
  min-height: 92vh;
  box-shadow: 0px 2px 5px rgba(0,0,0,0.5);
}
.content-editor .splitter {
  flex: 0 0 auto;
  width: 18px;
  min-height: 200px;
  cursor: col-resize;
  transition: all .3s ease-in-out;
}
.content-editor .splitter:hover {
  background-color: #ccc;
}
.content-editor .content-left {
  flex: 0 0 auto;
  width: 50vw;
  min-width: 5%;
  max-width: 98%;
  background-color: #ccc;
}
.content-editor .body-source {
  height: 93vh;
  padding: 0;
}
.content-editor .ctrl {
  display: flex;
}
.content-editor .content-right {
  flex: 1 1 auto;
  width: 100%;
  background: #fff;
}
.content-editor .frame {
  width: 100%;
  height: 100%;
  border: none;
}
.stamp {
  position: absolute;
  bottom: 0;
  right: 10px;
  padding: 0 10px;
  background: #000000e6;
}

.wrapper-editor {
  z-index: 99999;
}
#open-editor {
  position: fixed;
  z-index: 999999;
}

.content-edit .frame {
  border: none;
  width: 100%;
  min-height: 560px;
} 
 
.content-edit .frame p + pre, .content-edit .frame ul + pre {
  background: linear-gradient(45deg,#ddd,#d6c9c9);
  padding: 10px;
  max-width: 90%;
  margin: 20px auto;
  border-radius: 10px;
}

.btn-modal {
  position: absolute;
  top: 52px;
  right: 30px;
}
.dataTables_processing {
  position: absolute !important;
  top: 235px !important;
  right: 500px !important;
}

table thead tr th {
  text-transform: capitalize;
  text-align: center;
  color: #808080;
  cursor: pointer;
  background-color: #f1f1f1;
}
.dataTable tbody tr {
  border-bottom: 2px solid #808080;
}
.dataTable {
  border-spacing: 1px;
}
.dataTable tbody .order {
  cursor: grab;
}
.dataTable tbody tr td {
  text-align: center;
}
.dataTable tbody tr:hover {
  background-color: #d2d6de !important;
}
.dataTable tbody tr td .btn {
  display: block;
}
.dataTable tbody tr td:hover {
  background: linear-gradient(45deg,#ddd,#fff);
  border-color: transparent;
}
.dataTable tbody tr td .btn.btn-title,
.dataTable tbody tr td .btn.btn-slug,
.dataTable tbody tr td .btn.btn-quest {
  text-align: left;
}
</style>
</head>
<body id="page-top">
	<div class="alert-auto">
		<p class="m-1"></p>
	</div>
  <div id="wrapper">
		<?php if (!$editPage) { ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url()?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Note</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url()?>a">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">Table</div>

      <li class="nav-item">
      	<!-- colapsed -->
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Lessons</span>
        </a>
        <!-- show -->
        <div id="collapseTwo" class="collapse" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- active -->
            <a class="collapse-item" href="<?=base_url('a')?>/less/beginner">Beginner</a>
            <a class="collapse-item" href="<?=base_url('a')?>/less/medium">Medium</a>
            <a class="collapse-item" href="<?=base_url('a')?>/less/advance">Advance</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Quiz</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url('a')?>/quiz/beginner">Beginner</a>
            <a class="collapse-item" href="<?=base_url('a')?>/quiz/medium">Medium</a>
            <a class="collapse-item" href="<?=base_url('a')?>/quiz/advance">Advance</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">Configuration</div>

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Login</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block my-0">

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
		<?php } ?>

    <div id="content-wrapper" class="d-flex flex-column">
