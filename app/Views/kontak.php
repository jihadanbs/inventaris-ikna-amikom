
<?= $this->include('layouts/template') ?>

<body class="sub_page">
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- Start Kontak section -->
    <section class="kontak_section layout_padding">
        <div class="container-fluid text-center">
            <!-- Judul -->
            <h2 class="mb-4">Hubungi Kami Melalui</h2>

            <!-- Row untuk Card -->
            <div class="row justify-content-center">
                <!-- Card TikTok -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="currentColor"
                                    class="bi bi-tiktok" viewBox="0 0 16 16" style="color:black">
                                    <path
                                        d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                </svg>
                                <h5 class="card-title mt-3">TikTok</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card Instagram -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-instagram" style="font-size: 3rem; color: #E1306C;"></i>
                                <h5 class="card-title mt-3">Instagram</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card Facebook -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-facebook" style="font-size: 3rem; color: #3b5998;"></i>
                                <h5 class="card-title mt-3">Facebook</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- FAQ Section -->
            <section class="bsb-faq-2 bg-light py-3 py-md-5 py-xl-8 text-left">
                <div class="container">
                <h2 class="m-5 text-center">Frequently Asked Questions (FAQ)</h2>
                    <div class="row gy-5 gy-lg-0">
                        <div class="col-12 col-lg-6">
                        <h2 class="h2 mb-3">Bagaimana kami dapat membantu Anda? Temukan jawaban untuk semua pertanyaan tentang IKNAventory.</h2>
                        <p class="lead text-secondary mb-4" style="text-align: justify;">IKNAventory adalah sistem manajemen inventaris terpercaya yang dikembangkan oleh UKM IKNA Universitas AMIKOM Yogyakarta. Kami menyediakan solusi lengkap untuk membantu Anda mengelola aset dan inventaris dengan lebih efisien.</p>   
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-xl-11">
                                    <div id="accordionExample" class="accordion">
                                        <!-- FAQ Item 1 -->
                                        <div class=" mb-4 shadow-md border-faq ">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn text-left font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        How Do I Change My Billing Information?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p>To change your billing information, please follow these steps:</p>
                                                    <ul>
                                                        <li>Go to our website and sign in to your account.</li>
                                                        <li>Click on your profile picture in the top right corner of the page and select "Account Settings."</li>
                                                        <li>Under the "Billing Information" section, click on "Edit."</li>
                                                        <li>Make your changes and click on "Save."</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FAQ Item 2 -->
                                        <div class="mb-4 shadow-md border-faq">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        How Does Payment System Work?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    A payment system is a way to transfer money from one person or organization to another. It is a complex process that involves many different parties, including banks, credit card companies, and merchants.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FAQ Item 3 -->
                                        <div class=" mb-4 shadow-md border-faq ">
                                            <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Will taxes be included in my monthly invoice?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    Whether or not taxes are included in your monthly invoice depends on a number of factors, including your location, the type of services you are receiving, and the policies of the company providing you with those services.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FAQ Item 4 -->
                                        <div class=" mb-4 shadow-md border-faq">
                                            <div class="card-header" id="headingFour">
                                                <h2 class="mb-0">
                                                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        What currency will I be charged in?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    The currency you are charged in when making a purchase will depend on a number of factors, including the merchant you are purchasing from, the country you are purchasing from, and the payment method you are using.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FAQ Item 5 -->
                                        <div class="mb-4 shadow-md border-faq">
                                            <div class="card-header" id="headingFive">
                                                <h2 class="mb-0">
                                                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                        How Do I Cancel My Account?
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <p>To cancel your account, please follow these steps:</p>
                                                    <ul>
                                                        <li>Go to our website and sign in to your account.</li>
                                                        <li>Click on your profile picture in the top right corner of the page and select "Account Settings."</li>
                                                        <li>Scroll to the bottom of the page and click on "Cancel Account."</li>
                                                        <li>Enter your password and click on "Cancel Account."</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center p-3">
                                            <button class="tombol-lebih-lanjut-faq btn border border-radius">Lebih lanjut</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>
    <!-- End Kontak section -->

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>
<script>
    // Pastikan jQuery sudah dimuat di proyek Anda.
$(document).ready(function() {
    // Simpan FAQ tambahan dalam array
    const additionalFaqs = [
        `<!-- FAQ Item 6 -->
        <div class="mb-4 shadow-md border-faq">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        How Can I Update My Profile Information?
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    To update your profile information, navigate to "Account Settings" and edit the desired fields.
                </div>
            </div>
        </div>`,

        `<!-- FAQ Item 7 -->
        <div class="mb-4 shadow-md border-faq">
            <div class="card-header" id="headingSeven">
                <h2 class="mb-0">
                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        What Happens If I Forget My Password?
                    </button>
                </h2>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                    You can reset your password by clicking "Forgot Password" on the login page and following the instructions.
                </div>
            </div>
        </div>`,

        `<!-- FAQ Item 8 -->
        <div class="mb-4 shadow-md border-faq">
            <div class="card-header" id="headingEight">
                <h2 class="mb-0">
                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        Can I Change My Subscription Plan?
                    </button>
                </h2>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                <div class="card-body">
                    Yes, you can change your subscription plan at any time under "Subscription Settings."
                </div>
            </div>
        </div>`,

        `<!-- FAQ Item 9 -->
        <div class="mb-4 shadow-md border-faq">
            <div class="card-header" id="headingNine">
                <h2 class="mb-0">
                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        Is There A Refund Policy?
                    </button>
                </h2>
            </div>
            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                <div class="card-body">
                    Refunds are available based on our policy terms, which you can find in the "Help" section.
                </div>
            </div>
        </div>`,

        `<!-- FAQ Item 10 -->
        <div class="mb-4 shadow-md border-faq">
            <div class="card-header" id="headingTen">
                <h2 class="mb-0">
                    <button class="btn text-left font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        How Can I Contact Customer Support?
                    </button>
                </h2>
            </div>
            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                <div class="card-body">
                    You can contact customer support through the "Contact Us" page on our website.
                </div>
            </div>
        </div>`
    ];

   
    let additionalFaqsVisible = false; // Flag to track FAQ visibility

    $(".tombol-lebih-lanjut-faq").click(function() {
        if (!additionalFaqsVisible) {
            // Prepend additional FAQs to the accordion, before the button
            $("#accordionExample .d-flex").before(additionalFaqs.join(""));
            $(this).text("Lebih Sedikit"); // Update button text
        } else {
            // Remove additional FAQs
            $("#accordionExample .shadow-md.border-faq").slice(-5).remove();
            $(this).text("Lebih Lanjut"); // Reset button text
        }

        additionalFaqsVisible = !additionalFaqsVisible; // Toggle flag
    });
});

</script>
</body>


