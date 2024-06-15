<!-- Scripts -->
<?php $this->carabiner->display('css'); ?>
<script src="{base_url}assets/javascript/libs/modernizr-1.7.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
<script src="{base_url}assets/javascript/plugins.js"></script>
<script src="{base_url}assets/javascript/script.js"></script>
<style>
.map {
	width : 100%;
	height : 500px;
	background-color : #eee;
	border:1px black;
}
.gm-style-iw{
width : 240px;
}
</style>
<div class="panel-heading">
</div> 
<div id="map" class="map"></div>
<!-- Display javascript loaded through carabiner --> 
<?php $this->carabiner->display('js'); ?>

<!-- Output Google Maps scripts -->
<?php echo $this->google_maps->output(); ?>

