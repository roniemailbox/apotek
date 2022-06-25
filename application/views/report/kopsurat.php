<?php $id = get_cookie('eklinik'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/paper.css') ?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
				  body {
				      width: 100%;
				      height: 100%;
				      margin: 0;
				      padding: 0;
				      background-color: #FAFAFA;
				      /* font: 11pt "Arial"; */
					  font: "Courier New", 11pt;
				  }
				  * {
				      box-sizing: border-box;
				      -moz-box-sizing: border-box;
				  }
				  .page {
				      width: 297mm;
				      min-height: 210mm;
				      padding: 10mm;
				      margin: 5mm auto;
				      border: 1px #D3D3D3 solid;
				      border-radius: 5px;
				      background: white;
				      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
					  page-break-after: always;
				  }
				  .subpage {
				      padding: 1cm;
				      border: 5px red solid;
				      height: 257mm;
				      outline: 2cm #FFEAEA solid;
				  }

				  @page {
				      size: A4;
				      margin: 0;
				  }
				  @media print {
				      html, body {
				          width: 297mm;
				          height: 210mm;
				      }
				      .page {
				          margin: 0;
				          border: initial;
				          border-radius: initial;
				          width: initial;
				          min-height: initial;
				          box-shadow: initial;
				          background: initial;
				          page-break-after: always;
				      }
				  }
</style>
</head>
 
