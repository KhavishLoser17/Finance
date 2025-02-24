<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Bus Management System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'open-sans': ['"Open Sans"', 'sans-serif']
                        }
                    }
                }
            }
        </script>
        <style type="text/tailwindcss">

            @layer components {
                .section-padding {
                    @apply py-20;
                }
                .parallax-content {
                    @apply bg-cover bg-fixed bg-center py-32 text-white;
                }
                .baner-content {
                    background-image: url('{{ asset('img/cebu.jpg') }}');
                    height: auto;
                    position: relative;

                }
                .projects-content {
                    background-image: url('{{ asset('img/ilocos.jpg') }}');
                }
                .contact-content {
                    background-image: url('{{ asset('img/bicol.jpg') }}');
                }
                .line-dec {
                    @apply w-20 h-0.5 bg-black my-4;
                }
                .primary-button a {
                    @apply inline-block bg-white text-black px-6 py-2 font-semibold transition-all
                    duration-300 hover:bg-black hover:text-white rounded-sm mt-4;
                }
                .fixed-side-navbar {
                    @apply fixed top-1/2 transform -translate-y-1/2 right-0 z-30;
                }
                .fixed-side-navbar a {
                    @apply flex items-center justify-end bg-black bg-opacity-40 text-white py-2 px-4
                    mb-2 transition-all duration-300 hover:bg-white hover:text-black;
                }
                .service-item {
                    @apply bg-white p-6 shadow-lg mb-6;
                }
                .tabs-content img {
                    @apply w-full mb-5;
                }
                .tabs {
                    @apply flex border-b mb-6;
                }
                .tabs li {
                    @apply flex-1 text-center;
                }
                .tabs li a {
                    @apply block py-3 border-b-2 border-transparent hover:border-gray-800;
                }
                .tabs li a.active {
                    @apply border-gray-800;
                }
                .tabgroup > div {
                    @apply hidden;
                }
                .tabgroup > div:first-child {
                    @apply block;
                }
             .nav-item:hover a {
                    width: 50; /* Expands width on hover */
                    background-color: white; /* Change background */
                    color: black; /* Change text color */
                }
            }
        </style>
    </head>
<body class="font-open-sans">

    <div class="fixed top-1/2 right-4 z-30 flex flex-col space-y-2 transform -translate-y-1/2">
        <ul>
            <li class="nav-item">
                <a href="#home" class="group flex items-center justify-center w-10 h-10 bg-black bg-opacity-50 text-white rounded-full transition-all duration-300 hover:w-32 hover:bg-white hover:text-black shadow-lg px-4 overflow-hidden">
                    <span class="w-0 opacity-0 group-hover:w-auto group-hover:opacity-100 transition-all duration-300 ml-3 text-center">Intro</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#services" class="group flex items-center justify-start w-10 h-10 bg-black bg-opacity-50 text-white rounded-full transition-all duration-300 hover:w-32 hover:bg-white hover:text-black shadow-lg px-4 overflow-hidden">
                    <span class="w-0 opacity-0 group-hover:w-auto group-hover:opacity-100 transition-all duration-300 ml-3">Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#portfolio" class="group flex items-center justify-start w-10 h-10 bg-black bg-opacity-50 text-white rounded-full transition-all duration-300 hover:w-32 hover:bg-white hover:text-black shadow-lg px-4 overflow-hidden">
                    <span class="w-0 opacity-0 group-hover:w-auto group-hover:opacity-100 transition-all duration-300 ml-3">Portfolio</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#our-story" class="group flex items-center justify-start w-10 h-10 bg-black bg-opacity-50 text-white rounded-full transition-all duration-300 hover:w-32 hover:bg-white hover:text-black shadow-lg px-4 overflow-hidden">
                    <span class="w-0 opacity-0 group-hover:w-auto group-hover:opacity-100 transition-all duration-300 ml-3">Our Story</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#contact-us" class="group flex items-center justify-start w-10 h-10 bg-black bg-opacity-50 text-white rounded-full transition-all duration-300 hover:w-32 hover:bg-white hover:text-black shadow-lg px-4 overflow-hidden">
                    <span class="w-0 opacity-0 group-hover:w-auto group-hover:opacity-100 transition-all duration-300 ml-3">Contact</span>
                </a>
            </li>
     </div>



    <div class="parallax-content baner-content flex items-center justify-center" id="home">
        <div class="container mx-auto px-4">
            <a href="{{route('auth.signin')}}" class="absolute top-4 right-4 bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                Sign In
            </a>
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-2">Bus Transportation Management</h1>
                <span class="text-2xl block mb-8">Finance</span>
                <div class="primary-button">
                    <a href="#services">Discover More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section-padding relative bg-cover bg-center 10vh" id="services" style="background-image: url('{{ asset('img/bus4.jpg') }}');">
        <div class="absolute inset-0 bg-opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4">
                    <div class="mb-6 text-black">
                        <h4 class="text-2xl font-semibold">More About Vanilla</h4>
                        <div class="line-dec"></div>
                        <p class="mb-4">Vanilla is free Tailwind theme and you can apply this theme for your sites.
                            Please share our <a class="text-blue-400 hover:underline" href="https://templatemo.com">website</a> to your friends or colleagues. Thank you.</p>
                        <ul class="mb-6">
                            <li class="mb-2">- Praesent porta urna id eros</li>
                            <li class="mb-2">- Curabitur consectetur malesuada</li>
                            <li class="mb-2">- Nam pretium imperdiet enim</li>
                            <li class="mb-2">- Sed viverra arcu non nisi efficitur</li>
                        </ul>
                        <div class="primary-button">
                            <a href="#portfolio" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Learn More About Us</a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-2/3 px-4">
                    <div class="flex flex-wrap -mx-4 text-black">
                        <div class="w-full md:w-1/2 px-4">
                            <div class="service-item">
                                <h4 class="text-xl font-semibold">Classic Modern Design</h4>
                                <div class="line-dec"></div>
                                <p>Sed lacinia ligula est, at venenatis ex iaculis quis. Morbi sollicitudin nulla eget odio pellentesque.</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <div class="service-item">
                                <h4 class="text-xl font-semibold">Unique &amp; Creative Ideas</h4>
                                <div class="line-dec"></div>
                                <p>Sed lacinia ligula est, at venenatis ex iaculis quis. Morbi sollicitudin nulla eget odio pellentesque.</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <div class="service-item">
                                <h4 class="text-xl font-semibold">Effective Team Work</h4>
                                <div class="line-dec"></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacinia ligula est, at venenatis ex iaculis quis.</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-4">
                            <div class="service-item">
                                <h4 class="text-xl font-semibold">Fast Support 24/7</h4>
                                <div class="line-dec"></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacinia ligula est, at venenatis ex iaculis quis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="parallax-content projects-content" id="portfolio">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <a href="{{ asset('img/pangasinan.jpg') }}">
                        <img class="w-full" src="{{ asset('img/pangasinan.jpg') }}" alt="">
                    </a>
                    <div class="p-4">
                        <h4 class="text-lg font-semibold mb-1 text-black">Manila to Pangasinan</h4>
                        <span class="text-black">$18.00</span>
                    </div>
                </div>
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <a href="{{ asset('img/cebu.jpg') }}">
                        <img class="w-full" src="{{ asset('img/cebu.jpg') }}" alt="">
                    </a>
                    <div class="p-2 text-black">
                        <h4 class="text-lg font-semibold mb-1">Manila to Cebu</h4>
                        <span class="text-gray-700">$27.00</span>
                    </div>
                </div>
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <a href="{{ asset('img/3rd-big-item.jpg') }}">
                        <img class="w-full" src="{{ asset('img/bulacan.jpg') }}" alt="">
                    </a>
                    <div class="p-4 text-black">
                        <h4 class="text-lg font-semibold mb-1">Manila to Bulacan</h4>
                        <span class="text-gray-700">$36.00</span>
                    </div>
                </div>
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <a href="{{ asset('img/4th-big-item.jpg') }}">
                        <img class="w-full" src="{{ asset('img/baguio.jpg') }}" alt="">
                    </a>
                    <div class="p-4 text-black">
                        <h4 class="text-lg font-semibold mb-1">Manila to Baguio</h4>
                        <span class="text-gray-700">$45.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-padding relative bg-cover bg-center py-20 flex items-center" id="our-story" style="background-image: url('{{ asset('img/bus5.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="max-w-3xl mx-auto px-4 relative z-10 text-white">
            <div class="wrapper">
                <!-- Tab Content -->
                <section id="first-tab-group" class="tabgroup space-y-6">
                    <div id="tab1" class="hidden">
                        <img src="{{ asset('img/1st-tab.jpg') }}" alt="Tab 1" class="w-full rounded-lg">
                        <p class="mt-4">Please do not re-distribute our template ZIP file on your template collection sites. You can make a screenshot and a link back to our website. This template can be used for personal or commercial purposes by end-users.</p>
                    </div>
                    <div id="tab2" class="hidden">
                        <img src="{{ asset('img/2nd-tab.jpg') }}" alt="Tab 2" class="w-full rounded-lg">
                        <p class="mt-4">Aliquam eu ultrices risus, sed condimentum diam. Duis risus nulla, elementum vitae nisi a, ornare maximus nisl.</p>
                    </div>
                    <div id="tab3" class="hidden">
                        <img src="{{ asset('img/3rd-tab.jpg') }}" alt="Tab 3" class="w-full rounded-lg">
                        <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacinia ligula est, at venenatis ex iaculis quis.</p>
                    </div>
                    <div id="tab4" class="hidden">
                        <img src="{{ asset('img/4th-tab.jpg') }}" alt="Tab 4" class="w-full rounded-lg">
                        <p class="mt-4">Duis risus nulla, elementum vitae nisi a, ornare maximus nisl. Morbi et vehicula est. Cras at vulputate justo.</p>
                    </div>
                </section>

                <!-- Tab Navigation -->
                <ul class="tabs flex justify-center gap-4 mt-6" data-tabgroup="first-tab-group">
                    <li><a href="#tab1" class="tab-link active text-lg font-semibold hover:text-blue-400">2008 - 2014</a></li>
                    <li><a href="#tab2" class="tab-link text-lg font-semibold hover:text-blue-400">2014 - 2016</a></li>
                    <li><a href="#tab3" class="tab-link text-lg font-semibold hover:text-blue-400">2016 - 2019</a></li>
                    <li><a href="#tab4" class="tab-link text-lg font-semibold hover:text-blue-400">2019 - Now</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="parallax-content contact-content" id="contact-us">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4">
                    <div class="bg-white p-6 rounded shadow-lg text-black">
                        <form id="contact" action="" method="post">
                            @csrf
                            <div class="mb-4">
                                <input name="name" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" id="name" placeholder="Your name..." required>
                            </div>
                            <div class="mb-4">
                                <input name="email" type="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" id="email" placeholder="Your email..." required>
                            </div>
                            <div class="mb-4">
                                <textarea name="message" rows="6" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" id="message" placeholder="Your message..." required></textarea>
                            </div>
                            <div>
                                <button type="submit" id="form-submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors duration-300">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <div class="h-96">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.531696548384!2d121.04346544730898!3d14.625733040141174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b78cf262117d%3A0xab27b40d1ce5c2a5!2sCubao%20Bus%20Terminal!5e0!3m2!1sen!2sph!4v1740133609450!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="primary-button mb-6">
                <a href="#home">Back To Top</a>
            </div>
            <ul class="flex justify-center mb-6">
                <li class="mx-2"><a href="#" class="text-2xl hover:text-gray-400 transition-colors duration-300"><i class="fab fa-facebook"></i></a></li>
                <li class="mx-2"><a href="#" class="text-2xl hover:text-gray-400 transition-colors duration-300"><i class="fab fa-twitter"></i></a></li>
                <li class="mx-2"><a href="#" class="text-2xl hover:text-gray-400 transition-colors duration-300"><i class="fab fa-linkedin"></i></a></li>
                <li class="mx-2"><a href="#" class="text-2xl hover:text-gray-400 transition-colors duration-300"><i class="fab fa-google"></i></a></li>
                <li class="mx-2"><a href="#" class="text-2xl hover:text-gray-400 transition-colors duration-300"><i class="fab fa-dribbble"></i></a></li>
            </ul>
            <p>Copyright &copy; 2025 Company Name - Design: <a class="hover:text-gray-400" href="https://templatemo.com"><em>TemplateMo</em></a></p>
        </div>
    </footer>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>')</script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Tab functionality
        $(document).ready(function() {
            $('.tabs a').on('click', function(e) {
                e.preventDefault();
                var tabId = $(this).attr('href');

                // Remove all active classes
                $('.tabs a').removeClass('active');
                // Hide all tab content
                $('.tabgroup > div').hide();

                // Add active class to clicked tab
                $(this).addClass('active');
                // Show the related tab content
                $(tabId).show();
            });

            // Smooth scrolling
            $(".fixed-side-navbar a, .primary-button a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
</body>
</html>
