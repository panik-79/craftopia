<?php 
require('top.php');					
?>
<style>
/* FAQ Section Styles */
.faq__accordion .btn-link {
    text-align: left;
    font-size: 18px;
    color: #333;
    background: transparent;
    border: none;
    padding: 15px 0;
    transition: all 0.3s ease-in-out;
    margin-left:20px;
}

.faq__accordion .btn-link:hover {
    color: #c43b68; /* Change this color to your preferred highlight color */
    text-decoration: none;
}

.faq__accordion .card {
    border: none;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.faq__accordion .card-body {
    font-size: 16px;
    color: #777;
    padding: 20px;
}

.faq__accordion .btn-link.active {
    color: #c43b68; /* Change this color to match the highlight color */
}

/* Optional: Add some styling for the FAQ header */
.faq__header {
    text-align: center;
    margin-bottom: 40px;
}

.faq__header h2 {
    font-size: 36px;
    font-weight: 600;
    color: #333;
}

/* Optional: Adjust spacing and margin for the FAQ section */
.faq__area {
    padding-top: 60px;
    padding-bottom: 60px;
}

</style>

        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="contact-form-wrap mt--60">
                        <div class="col-xs-12">
                            <div class="contact-title">
                                <h2 class="title__line--6">SEND A MAIL</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form id="contact-form" action="#" method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box name">
                                        <input type="text" id="name" name="name" placeholder="Your Name*">
                                        <input type="email" id="email" name="email" placeholder="Email*">
										<input type="email" id="mobile" name="mobile" placeholder="Mobile*">
                                    </div>
                                </div>
                                
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="message" id="message" placeholder="Your Message"></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="button" onclick="send_message()" class="mybtn">Send MESSAGE</button>
                                </div>
                            </form>
                            <div class="form-output">
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
<!-- Start FAQ Area -->

<section class="faq__area pb--120 bg__white">
    <div class="container">
        <div class="faq__header">
            <h2>Frequently Asked Questions</h2>
        </div><br><br>
        <div class="row">
            <div class="col-xs-12">
                <div class="faq__wrap">
                    <div class="faq__accordion" id="accordion">
                        <!-- FAQ Item 1 -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Question : What payment methods do you accept?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                     We accept payments through PayU and Cash On Delivery
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Question :  Are the handicraft items handmade?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                     Yes, all of our handicraft items are handmade by skilled artisans. We take pride in supporting traditional craftsmanship and providing you with unique, one-of-a-kind pieces.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Question :  Can I cancel my order after it's been placed?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                     You can request to cancel your order within 24 hours of placing it. Please contact our customer support team as soon as possible with your order details. After 24 hours, we may have already processed your order for shipment.
                                </div>
                            </div>
                        </div>

                        <!-- Add more FAQ items as needed -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->
<script>
    $(document).ready(function () {
        $('.collapse').on('show.bs.collapse', function () {
            $(this).prev().find('.btn-link').addClass('active');
        });

        $('.collapse').on('hide.bs.collapse', function () {
            $(this).prev().find('.btn-link').removeClass('active');
        });
    });
</script>

<?php require('footer.php')?>        