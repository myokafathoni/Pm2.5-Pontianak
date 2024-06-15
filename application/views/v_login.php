        <link rel="icon" type="image/png" href="<?php  echo base_url() ?>assets/images/logo.png"/>
<body class='special-page'>
        <div id='container'>
		
            <section id='login-box'>
			
                <div class='block-border'>   
<table cellpadding="4" cellspacing="4" border="0" width="100%">
<tr style="border-bottom:1px solid white;margin-bottom:2px;">
<td align="center" style="margin-bottom:2px;">
<img height="77px" src="<?=base_url();?>assets/images/logo.png" >	
</td>
<td align="center">
<font size="3px" color="white">
PREDICTION OF POLLUTANTS CONCENTRATION PM</font><font size='2px' color="white"><b>2.5</b></font>
<font size="3px" color="white">
USING</font>
<font size="4px" color="white"><BR>
 FUZZY TIME SERIES 
</font>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<font size="4px" color="white">
Air Quality<br>
</font>
</td>
</tr>
</table>
				
<div class='block-header'>
<h1>LOGIN USER</h1>
</div>
<form class="block-content form" id="login-form" method="post" action="<?php  echo base_url() ?>login/cek_login/">
<p class='inline-small-label'>
    <label for='username'>Username</label>
  <input id="txtUser" type="text" class="required" name="username" title="Username" value="" size="30" maxlength="2048" />
</p>
<p class='inline-small-label'>
    <label for='password'>Password</label>
  <input id="txtPassword" type="password" class="required" name="password" title="Password" value="" size="30" maxlength="2048" />
</p>
                        <div class='clear'>
                        </div>
                        <div class='block-actions'>
                            <ul class='actions-right'>
                            <li><input type='submit' id="btnLogin" class='button' value='Login'></li>
                            </ul>
                        </div>
</form>
                                    </div>
            
            </section>
        </div>
</body>
