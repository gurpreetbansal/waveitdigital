<?php include("header.php"); ?>

<main class="content">
    <section class="contact-section">
        <div class="container">
            <div class="border-shape animate max-width text-center">
                <span class="line-TopLeft"></span>
                <span class="line-BottomRight"></span>
                <h6>Contact US</h6>
                <h2>Have A Project in Mind?</h2>
                <a href="javascript:void(0)" class="btn btn-primary">SET UP A CONSULTATION</a>
            </div>
            <div class="row row-cols-1 row-cols-md-2 uTSpace">
                <div class="col">
                    <div class="left">
                        <h3>FIND US</h3>
                        <ul>
                            <li>
                                <span>Email Us</span>
                                <a href="mailto:info@devallum.com">info@devallum.com</a>
                            </li>
                            <li>
                                <span>Call Us</span>
                                <a href="tel:+917340750196">+91 73407 50196</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <form class="form">
                        <div class="control-group">
                            <input type="text" name="name" placeholder="Name">
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="control-group">
                            <textarea name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="subscribe-section">
        <div class="inner" style="background-image: url(images/background-attachment3.jpg);">
            <div class="border-shape light animate max-width text-center">
                <span class="line-TopLeft"></span>
                <span class="line-BottomRight"></span>
                <h6>STAY IN TOUCH</h6>
                <h2>Subscribe to Our Newsletter</h2>
            </div>
        </div>
        <div class="container">
            <div class="form-box">
                <form class="form">
                    <div class="control-group">
                        <input type="text" name="first-name" placeholder="First Name">
                    </div>
                    <div class="control-group">
                        <input type="text" name="last-name" placeholder="Last Name">
                    </div>
                    <div class="control-group">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>