<?php
if($this->session->flashdata('message')){
	?>

	<script src="<?php echo base_url();?>assets/js/jquery-1.12.4.min.js"></script>
	<script>
	//When the page has loaded.
	$( document ).ready(function(){
		$('#pesan_ku').fadeIn('slow', function(){
		   $('#pesan_ku').delay(2000).fadeOut();
		});
	});
	</script>

	<h4>
			<div id="pesan_ku" class="alert alert-<?php echo $this->session->flashdata('jenis') ?>">
				<?php echo " ".$this->session->flashdata('message')?>
			</div>
			<input type="text" id="pesan_ku_temp" hidden
				value="<?php echo $this->session->flashdata('message'); ?>" />
		</h4>
	<?php
} ?>
