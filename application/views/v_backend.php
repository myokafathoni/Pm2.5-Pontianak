<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--
    <html>
    -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="icon" type="image/png" href="<?php  echo base_url() ?>assets/images/logo.png"/>

        <title>
            <?php 
            echo $this->config->item("web_title");
            if (isset($title)) {
                echo " - " . $title . "\n";
            }
            ?>
        </title>

        <?php  if ($this->config->item("use_jquery")) { ?>
            <script type="text/javascript" src="<?php  echo base_url() ?>assets/js/libs/jquery-1.6.2.min.js"></script>
            <?php 
        }
        ?>

        <link href="<?php  echo base_url() ?>assets/css/c11f8f1b6c157a7a1ee04039d038c282336416b9.css" rel="stylesheet" type="text/css" />
        <script src="<?php  echo base_url(); ?>assets/js/libs/modernizr-2.0.6.min.js"></script>
        <script src="<?php  echo base_url(); ?>assets/js/8f71c247c4dadc837fe569208a7a1dc0f7625c46.js"></script>
		<link href="<?php  echo base_url();?>assets/js/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script language="javascript" src="<?php  echo base_url();?>assets/js/facebox/facebox.js"></script>
		<script type="text/javascript">
		$(function() {
		$.facebox.settings.closeImage = '<?php  echo base_url();?>assets/js/facebox/closelabel.png'
		$.facebox.settings.loadingImage = '<?php  echo base_url();?>assets/js/facebox/facebox/loading.gif'
		});
		</script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
			  $('a[rel*=facebox]').facebox()
			})
		</script>
		<script type="text/javascript" src="<?php  echo base_url();?>assets/js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			 setInterval(function(){
			 // $('#badge_M0009').load('<?php  echo base_url();?>pohon/jumlah');
			 }, 1000);
		</script>
    </head>

    <body id='top'>
        <div id='container'>
            <?php 
            $this->load->view("v_header");
            ?>
            <div class='fix-shadow-bottom-height'>
            </div>
            <aside id='sidebar'>
                <section id='login-details'>
					
				<table>
				<tr>
				<td valign="center">
				<img class="img-left" height="60px" src="<?php echo base_url(); ?>assets/images/logo.png" alt="Perusahaan">
				</td>
				<td valign="center" style="padding-top:10px;">
				<a href="<?php echo base_url(); ?>">
				<font size='2px' face="Arial" color="white"><b>CONCENTRATION PREDICTION</b></font></a>
				<font size='2px' face="Arial" color="white"><b>PM POLLUTION</font><font size='1px' face="Arial" color="white">2.5</font></b></a>
				<font size='2px' face="Arial" color="white"><b></font></b></a>
				<!--<h2><a data-step="1" data-intro="Menu user disposisi" data-position='right' class='user-button' href="javascript:void(0);"><?php echo $this->session->userdata("nama") ?>&nbsp;<span class='arrow-link-down'></span></a></h2>
				<ul class='dropdown-username-menu'>
					<li><a href="<?php echo base_url().'beranda/detailuser/'.$this->session->userdata("username"); ?>">Profile</a></li>
					<li><a href="<?php echo base_url().'login/logout/'; ?>">Logout</a></li>
				</ul>-->
				</td>
				
				</tr>
                </table>   
					
                </section>

                <?php  echo $menu; ?>

            </aside>

            <div id='main' role='main'>
                <?php 
                if (isset($content)) {
                    echo $content;
                }
                ?>
            </div>

            <div class="clear height-fix">
            </div>
            <!-- footer -->
            <footer id='footer'>
                <?php  echo $this->load->view("v_footer"); ?>
            </footer>  

        </div>

    </body>
</html>
