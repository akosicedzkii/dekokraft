
    <section id="contact">
        <div class="overlay">
        <div class="container">
            <div class="row">
		<div class="col-md-12">
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Privacy Notice</h5>
      </div>
      <div class="modal-body">
        
                    <p>This privacy notice discloses the privacy practices for (website address). This privacy notice applies solely to information collected by this website. It will notify you of the following:</p>

                    <p>1.What personally identifiable information is collected from you through the website, how it is used and with whom it may be shared.</p>

                    <p>2.What choices are available to you regarding the use of your data.</p>

                    <p>3.The security procedures in place to protect the misuse of your information.</p>

                    <p>4.How you can correct any inaccuracies in the information.</p>

                    <p></p>

                    <h1>Information Collection, Use, and Sharing&#160;</h1>

                    <p>We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</p>

                    <p></p>

                    <p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>

                    <p></p>

                    <p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>

                    <p></p>

                    <h1>Your Access to and Control Over Information&#160;</h1>

                    <p>You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address or phone number given on our website:</p>

                    <p>&bull;See what data we have about you, if any.</p>

                    <p>&bull;Change/correct any data we have about you.</p>

                    <p>&bull;Have us delete any data we have about you.</p>

                    <p>&bull;Express any concern you have about our use of your data.</p>

                    <p></p>

                    <h1>Security&#160;</h1>

                    <p>We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.</p>

                    <p></p>

                    <p>Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a lock icon in the address bar and looking for &quot;https&quot; at the beginning of the address of the Web page.</p>

                    <p></p>

                    <p>While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.</p>

                    <p></p>

                    <p>If you feel that we are not abiding by this privacy policy, you should contact us immediately via via email ______________________.</p>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	       
	</div>
            </div>
        </div>
            <div class="container">
                <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.2s">
                    <div class="col-md-6 col-md-offset-3 pad-bottom">
                        <h2><strong>Contact Us </strong></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" id="contact-form" class="contact-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" required class="form-control" name="Name" autocomplete="off" id="contact-name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="email" required class="form-control" name="email" autocomplete="off" id="contact-email" placeholder="E-mail">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" required class="form-control" name="mobile" autocomplete="off" id="contact-mobile" placeholder="Mobile Number">
                                        </div>
                                </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="subject" required class="form-control" name="subject" autocomplete="off" id="contact-subject" placeholder="Subject">
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control textarea" required rows="3" name="Message" id="contact-message" placeholder="Message"></textarea>
                                    </div>
                                    </div>
                                </div>
                                    <div class="row">
					<div class="col-md-12">

                                            <button type="submit" id="send" class="btn btn-success pull-right">Send a message</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.4s">

                                    <h3><strong>Address : </strong></h3>
                                    <h4><?php echo nl2br(COMPANY_ADDRESS);?></h4>
                                    <h4><strong>Email : </strong><?php echo CONTACT_US_EMAIL_ADDRESS;?></h4>

                                    <div class="row">
                                    <div class="col-12">

                                    <br />
                                        <div class="social-media-container">
                                        <?php
                                         if(FACEBOOK_URL != "")
                                         {
                                         ?>
                                           <a href="<?php echo FACEBOOK_URL;?>">
                                                <img src="<?php echo base_url();?>/assets_site/images/unioil-thumbnail-facebook.png" class="social-media-link" alt=""></a>
                                          <?php
                                         }
                                         ?>
                                        <?php
                                         if(TWITTER_URL != "")
                                         {
                                         ?>
                                            <a href="<?php echo TWITTER_URL;?>">
                                                <img src="<?php echo base_url();?>/assets_site/images/unioil-thumbnail-twitter.png" class="social-media-link" alt=""></a>
                                        <?php
                                         }
                                         ?>   
                                         <?php
                                         if(INSTAGRAM_URL != "")
                                         {
                                         ?>
                                            <a href="<?php echo INSTAGRAM_URL;?>">
                                                <img src="<?php echo base_url();?>/assets_site/images/unioil-thumbnail-instagram.png" class="social-media-link" alt=""></a>
                                        <?php
                                         }
                                         ?>  
                                        </div>
                                    </div>
                                
                                </div>

                            </div>
                        </dv>
                        
                    </div>
                </div>

                



            </div>
        </div>
    </section>
    <!-- CONTACT SECTION END -->
    <footer>
	&copy 2019 <?php echo SITE_NAME;?>   <a href="<?php echo base_url();?>" target="_blank"><!--by <?php echo SITE_NAME;?>--></a>
 	&emsp;<a "btn btn-primary" data-toggle="modal" href=# data-target="#exampleModal">
                                             Privacy Notice
                                                </a>

    </footer>
    <!--FOOTER SECTION END  -->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  SCRIPTS -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/bootstrap.js"></script>
    <!-- SCROLLING SCRIPTS PLUGIN  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery.easing.min.js"></script>
    <!--  FANCYBOX PLUGIN -->
    <script src="<?php echo base_url()."pink/assets/";?>js/source/jquery.fancybox.js"></script>
    <!-- ISOTOPE SCRIPTS -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery.isotope.js"></script>
     <!-- SCROLL ANIMATIONS  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/scrollReveal.js"></script>
    <!-- CUSTOM SCRIPTS   -->
    <script src="<?php echo base_url()."pink/assets/";?>js/custom.js"></script>
    <script>
        $('.navbar-nav>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });
        $('#contact-form').on('submit', function(e) {
            $("#send").button("loading");
                e.preventDefault();
                var values_contact_us_email = { "emailer_name" : "OSI Contact Us - " + $("#contact-name").val() ,  "to": $("#contact-email").val() , "body" : "Name:" + $("#contact-name").val() + " <br> Contact Number: " + $("#contact-mobile").val() + " <br> Contact Email: " + $("#contact-email").val() + " <br> Message: "+ $("#contact-message").val() }

                $.ajax({
                        url: "<?php echo base_url("sendemail/send_contact_us");?>",
                        type: "post",
                        data: values_contact_us_email ,
                        success: function (response) {
                        if(response == "Message sent")
                        {
                            alert("Thank you for reaching out to us.\nSomeone in our office will contact you shortly. \nHave a great day. \n\n-The OSI Team");
                            window.location = "";
                        }else{
                                alert(response);
                                window.location = "";
                            }						   
                                
			$("#send").button("reset");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
				$("#send").button("reset");
                        }


                    });
            
        });
    </script>

</body>
</html>
