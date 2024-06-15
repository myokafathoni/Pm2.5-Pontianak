		<script type="text/javascript">
			tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		elements : "ajaxfilemanager",
		skin : "o2k7",
		skin_variant : "black",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
		remove_script_host : false,
        convert_urls : false,
        forced_root_block : false,
		force_p_newlines : 'false',
		remove_linebreaks : true,
		force_br_newlines : false,              //btw, I still get <p> tags if this is false
		remove_trailing_nbsp : true,
		
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "admin",
			staffid : "fkbedah"
		}
		  
	});
	tinyMCE.init({
		mode : "exact",
		elements : "images_slide",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "black",
		plugins : "inlinepopups",
		remove_script_host : false,
        convert_urls : false,
        forced_root_block : false,
		force_p_newlines : 'false',
		remove_linebreaks : true,
		force_br_newlines : false,              //btw, I still get <p> tags if this is false
		remove_trailing_nbsp : true,   
		//verify_html : false

		// Theme options
		theme_advanced_buttons1 : "image",
		theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",

		// Replace values for the template plugin
		template_replace_values : {
			username : "admin",
			staffid : "1234567"
		}
			});
	function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "../../assets/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
			var view = 'detail';
			switch (type) {
				case "image":
				view = 'thumbnail';
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "../../assets/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
		}
		</script>


<div id='title-bar'>
			<ul id='breadcrumbs'>
				<li><a href="<?php  echo $home; ?>" title='<?php  echo $modul; ?>'><span id='bc-home'></span></a></li>
				<li><a href="#"> <?php  echo $modul; ?></a></li>
				<li><a href="#"> <?php  echo $title; ?></a></li>
                <li><?php  echo $subtitle; ?></li>
			</ul>
		</div>
		<div class="shadow-bottom shadow-titlebar">
		</div>
<div id='main-content'>
    <div class='container_12'>
        <div class='grid_12'>
            <h1><?php  echo $modul; ?></h1>
        </div>
        <div class='grid_12'>
            <div class='block-border'>
                <div class='block-header'>
                    <h1><?php  echo $subtitle; ?></h1>
                    <span></span>
                </div>
                <form id='validate-form' class="block-content form" action="<?php  echo base_url() . $act; ?>" method='post'>
					<div class='_100'>
                        <p>
                            <label for='JUDUL'>JUDUL</label>
                            <input id='JUDUL' name='JUDUL' class='required' type='text' value="<?php  echo set_value('JUDUL', isset($data['JUDUL']) ? $data['JUDUL'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='DESKRIPSI'>DESKRIPSI</label>
                            <input id='DESKRIPSI' name='DESKRIPSI' class='required' type='text' value="<?php  echo set_value('DESKRIPSI', isset($data['DESKRIPSI']) ? $data['DESKRIPSI'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='ISI'>ISI</label>
                            <textarea name='ISI' class='required' rows="10">
							<?php  echo set_value('ISI', isset($data['ISI']) ? $data['ISI'] : ''); ?>
							</textarea>
							<input id='TANGGAL' name='TANGGAL' class='required' type='hidden' value="<?php  echo set_value('TANGGAL', isset($data['TANGGAL']) ? $data['TANGGAL'] : date("Y-m-d H:i:s")); ?>"/>
                        </p>
                    </div>
				
					<input id='OLEH' name='OLEH'  type='hidden' value="<?php  echo $this->session->userdata("nama"); ?>"/>
					<div class='_100'>
                        <p>
                            <label for='AKTIF'>AKTIF</label>
							    <select name="AKTIF">
                                <?php
								if (isset($data['AKTIF']) && $data['AKTIF'] == "Y") 
								{
                                ?>
                                <option value="Y" selected>TAMPIL</option>	
								<option value="N">TIDAK TAMPIL</option>
								<?php
								} 
								else if (isset($data['AKTIF']) && $data['AKTIF'] == "N") { 
								?>
								<option value="Y">TAMPIL</option>	
                                <option value="N" selected>TIDAK TAMPIL</option>
								<?php
								}
								else
								{
								?>
								<option value="Y">TAMPIL</option>	
                                <option value="N">TIDAK TAMPIL</option>
								
								<?php
								}
								?>
                            </select>
							</p>
                    </div>
                    <div class='clear'>
                    </div>
                    <div class='block-actions'>
                        <ul class='actions-left'>
                            <li><input type='submit' class='button' value="Submit"></li>
							<li><a data-toggle="tooltip" href="<?php  echo $home; ?>" title="hapus" class="button red">Batal</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
