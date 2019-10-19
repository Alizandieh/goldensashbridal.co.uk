<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
$this->inc('elements/left_nav.php');
?>

        <!-- Page Wrap -->
        <div class="main_blog_wrap">
        
        	<div class="blogtitle">
                   	  	
            		<?php 
					    $a = new Area('Title');
					    $a->display($c);
					?>	
            
            </div>
            <div class="clear"></div>

            <!-- Google Map -->
            <div id="googlemap"></div>
            <!-- Google Map -->

            <div class="blogtitle">
                        
                    <?php 
                        $a = new Area('Title2');
                        $a->display($c);
                    ?>  
            
            </div>
            <div class="clear"></div>

            <div class="page_item">

                <!-- Page Content -->
                <div class="page_content_wrap">

                    <div class="clear"></div>
                    <!-- Description --> 
                    <div class="contactinfo_left">
                        <?php 
                            $a = new Area('Main1');
                            $a->display($c);
                        ?> 
                    </div>
                    <div class="contactinfo_right">
                        <?php 
                            $a = new Area('Main2');
                            $a->display($c);
                        ?> 
                    </div>
                    <!-- Description --> 
                
                </div>
                <!-- Page Content -->
            </div>
            
            <div class="clear"></div>          
            <!-- Page Item -->

            <div class="blogtitle bottom">
                        
                    <?php 
                        $a = new Area('bottom');
                        $a->display($c);
                    ?>  
            
            </div>

            <div class="page_content_wrap">
                
                <!-- Email Form -->
                <div class="commentwrap">
                
                    <!-- Full Comment -->
                    <div class="commentformwrap">
 
                    <p class="emailsuccess"></p>
                    <p class="emailfail"></p>                   
                    <form method="post" id="slickform" action="javascript:slickcontactparse();">
                        <fieldset>
                        
                            <input id="name" class="inputsection" name="name" type="text" onfocus=" if (this.value == 'name...') {this.value = '';}" onblur=" if (this.value == '') {this.value = 'name...';}" value="name..." />
                            <input id="email" class="inputsection_right" name="email" type="text" onfocus=" if (this.value == 'email...') {this.value = '';}" onblur=" if (this.value == '') {this.value = 'email...';}" value="email..." />
                            
                            <div class="clear" style="margin-bottom:3px;"></div>
                            <input id="phone" class="inputsection" name="phone" type="text" onfocus=" if (this.value == 'phone...') {this.value = '';}" onblur=" if (this.value == '') {this.value = 'phone...';}" value="phone..." />

                            <input id="date" class="inputsection_right" name="date" type="text" onfocus=" if (this.value == 'wedding date...') {this.value = '';}" onblur=" if (this.value == '') {this.value = 'wedding date...';}" value="wedding date..." />
                            
                            <textarea id="comment" name="comment" cols="5" rows="5" class="inputlargesection" onfocus=" if (this.value == 'Comment...') {this.value = '';}" onblur=" if (this.value == '') {this.value = 'Comment...';}">Comment...</textarea>
                            
                            <input name="submit" type="submit" value="Send Email" class="formbutton">
                        
                        </fieldset>
                    </form>
                        
                    </div>
                    <!-- Full Comment -->

                </div>
                <!-- Email Form -->               
            </div>


        </div>
        <!-- Page Wrap -->


<?php $this->inc('elements/footer.php'); ?>

