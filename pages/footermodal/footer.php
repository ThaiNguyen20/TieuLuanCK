<div class="line">
<div class="site-animation wrapper-heading-home wrapper-heading-home-instagram">
<div class="wrapper-animation2">
    <span class="text-animation-2">streetwear brand limited</span>
  </div>

    </div>

<footer class="main-footer"> 
<div class="line">

                    <div class="one">

                        <div class="one-1">
                            <h4 >TIÊU CHÍ CỦA CỬA HÀNG</h4><br>
                        <div class="one12">
                            <?php
                                $sql_chinhanh = "SELECT * FROM tbl_chinhanh ORDER BY id_chinhanh ASC";
                                $query_chinhanh = mysqli_query($mysqli,$sql_chinhanh);   
                                while($row_chinhanh= mysqli_fetch_array($query_chinhanh)){     
                            ?>
                            <p> 
                                <?php echo $row_chinhanh['chinhanh']?> <br>
                                
                            </p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                        $sql_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY id_tenchinhsach ASC";
                        $query_tenchinhsach = mysqli_query($mysqli,$sql_tenchinhsach);
                        
                    ?>
                        <div class="one-1">
                        <H4 >CHÍNH SÁCH</H4><br>
                        <div class="one12">
                        <ul class="one13">
                            <?php
                                while($row_tenchinhsach= mysqli_fetch_array($query_tenchinhsach)){
                            ?>
                            <!-- <li><a href="#" title="Chính sách sử dụng website"> Chính sách sử dụng website </a> </li><br> -->
                            <li><a href="./index.php?quanly=chinhsach&id=<?php echo $row_tenchinhsach['id_tenchinhsach'] ?>"><?php echo $row_tenchinhsach['tenchinhsach'] ?></a></li><br>
                            <?php } ?>
                        </ul>
                        </div>
                     </div>
                        <div class="one-1">
                            <H4 >THÔNG TIN LIÊN HỆ </H4><br>
                            <div>
                                <?php
                                    $sql_lienhe = "SELECT * FROM tbl_lienhe ORDER BY id_lienhe ASC";
                                    $query_lienhe = mysqli_query($mysqli,$sql_lienhe);   
                                    while($row_lienhe= mysqli_fetch_array($query_lienhe)){     
                                ?>
                                <ul class="one12">
                                    <li><?php echo $row_lienhe['lienhe']?></li>
                                    
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                     <div class="one-1">
                        <div class="one-footer">
                            <H4 >FOLLOW US ON SOCIAL MEDIA</H4><br><br>
                            <a href="https://web.facebook.com/profile.php?id=61553968582414" target="_blank">
                                <img src="https://png.pngtree.com/png-clipart/20190215/ourlarge/pngtree-facebook-icon-png-image_548407.jpg">   
                             </a>
                        <div class="one-footer1"> 
                            <a href="http://online.gov.vn/Home/WebDetails/78935?AspxAutoDetectCookieSupport=1">
                                <img src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png">
                            </a>
                        </div>
                        </div>     
                    </div>
                    <div class="one-1">
                        <div class="one-footer">
                            <h4>NHẬP MAIL ĐỂ ĐĂNG KÝ</h4>
                            <div id="mc_embed_shell">
                                <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
                                <style type="text/css">
                                    #mc_embed_signup{background:#fff; font:14px Helvetica,Arial,sans-serif;}
                                    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                                    We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                </style>
                                <div id="mc_embed_signup">
                                    <form action="https://gmail.us13.list-manage.com/subscribe/post?u=1d7ab30d324a44c8443be99d9&amp;id=134e38d4ea&amp;f_id=003583e4f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                                        
                                        <div class="mc-field-group">
                                            <label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label>
                                            <input style="width:100%" type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="">
                                            <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                                        </div>
                                        <div id="mce-responses" class="clear foot">
                                            <div class="response" id="mce-error-response" style="display: none;"></div>
                                            <div class="response" id="mce-success-response" style="display: none;"></div>
                                        </div>
                                        <div aria-hidden="true" style="position: absolute; left: -5000px;">
                                            /* real people should not fill this in and expect good things - do not remove this or risk form bot signups */
                                            <input type="text" name="b_1d7ab30d324a44c8443be99d9_134e38d4ea" tabindex="-1" value="">
                                        </div>
                                            <div class="optionalParent">
                                                <div class="clear foot">
                                                    <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Đăng ký">
                                                    <!-- <p style="margin: 0px auto;"><a href="http://eepurl.com/iFxGDs" title="Mailchimp - email marketing made easy and fun"><span style="display: inline-block; background-color: transparent; border-radius: 4px;"><img class="refferal_badge" src="https://digitalasset.intuit.com/render/content/dam/intuit/mc-fe/en_us/images/intuit-mc-rewards-text-dark.svg" alt="Intuit Mailchimp" style="width: 220px; height: 40px; display: flex; padding: 2px 0px; justify-content: center; align-items: center;"></span></a></p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                                    </div>
</footer>