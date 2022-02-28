@extends('layouts.home')
@section('title', __('Welcome'))
@section('content')
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center justify-content-center">

                    <div class="col-4">
                        <h1 class="m-0"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" width="200px"></a></h1>
                    </div>

                    <div class="col-8">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="#home-section" class="nav-link">Home</a></li>
                                <li><a href="#about-section" class="nav-link">About</a></li>
                                {{-- <li><a href="#accommodation-section" class="nav-link">Accommodation</a></li> --}}
                                <li><a href="#institution-section" class="nav-link">Institution</a></li>
                                <li><a href="#campus-section" class="nav-link">Campus</a></li>
                                <li><a href="#contact-section" class="nav-link">Contact</a></li>
                            </ul>
                        </nav>


                        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle float-right"><span
                                class="icon-menu h3"></span></a>

                    </div>


                </div>
            </div>

        </header>


        <div class="site-blocks-cover overlay bg-light" style="background-image: url('img/flat-mountains.svg'); "
            id="home-section">

            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-12 text-center align-self-center text-intro">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">

                                <h1 class="text-white" data-aos="fade-up" data-aos-delay=""> Study in Ireland</h1>
                                <p class="lead text-white" data-aos="fade-up" data-aos-delay="100">Working with key Universities, Health Sector Providers and Aviation Sector to assist students and professionals to achieve their goals and ambitions.</p>
                                {{-- <p data-aos="fade-up" data-aos-delay="200"><a href="#accommodation-section"
                                        class="btn smoothscroll btn-primary">Our Services</a></p> --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <div class="site-section" id="about-section">
            <div class="container">
                <div class="row ">
                    <div class="col-12 mb-4 position-relative">
                        <h2 class="section-title">About Us</h2>
                    </div>
                    <div class="col-lg-4">
                        <p> O’Brien Associates Educational Consultants (OBA) aims to help you in choosing your academic career, particularly if you are planning on studying abroad. OBA has all variety of courses offerings to choose from and enjoys close working relationships with educational institutions of high reputation throughout the world, including Ireland, Malaysia, United Arab Emirates (Dubai), USA and Europe. OBA is experienced in directing its students on productive educational career pathways, helping them to achieve success in reaching their goals and objectives.
                            </p>

                        <p>The Universities and Colleges, which are carefully chosen by OBA, are renowned for their long standing reputation, academic excellence and educational environments. Some of these institutions are among the top Universities in the World. OBA’s partner institutions are both state sector and privately funded organisations. All these institutions take pride in their past achievements while being aware of the ever changing international environment and prepare their graduates for global citizenship capable of adapting to an ever changing world.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="images/about.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-lg-4">
                        <p> Students are directed by OBA through the process of application to their chosen University/College according to costs, financial ability and academic ability of the student, and the ability to get a visa.
                            OBA makes the transition to studying abroad as easy as possible for the student by helping and advising students through:</p>
                            <ul>
                                <li>                            Career counselling (academic);
                                </li>
                                <li>                            Interview and Assessment;
                                </li>
                                <li>                            College/University Registration;
                                </li>
                                <li>                            Student Visas Assistance;
                                </li>
                                <li>                            Pre-orientation;
                                </li>
                                <li>                            Flights arrangement;
                                </li>
                                <li>                            Accommodation;
                                </li>
                                <li>                            Financial Bonding;
                                </li>
                                <li>                            Sponsorship for talented Students
                                </li>
                            </ul>

                        <p>  All OBA Institutional partners have strong international departments and are experienced in dealing with international students. OBA students can look forward to a carefully nurtured academic career leading to professional success.</p>
                    </div>




                </div>
            </div>
        </div>


        <div class="site-section" id="campus-section" style="background-image: url('img/radiant-gradient.svg');">
            <div class="container">
                <div class="row ">
                    <div class="col-12 mb-5 position-relative">
                        <h2 class="section-title text-center mb-5 text-white">Campus</h2>
                    </div>
                    @foreach ($campus as $item)
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="">
                        <div class="service d-flex h-100">
                            <div class="service-about">
                                <h3>{{ $item->name }}</h3>
                                <a href="{{ $item->link }}">Click hare to view.</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    {{-- <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service d-flex h-100">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/001-travel.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about">
                                <h3>Social Media Marketing</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>


        <section class="site-section block__62272" id="institution-section">


            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 position-relative">
                        <h2 class="section-title text-center mb-5">Institution</h2>
                    </div>
                    @foreach ($institution as $item)
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="service-about text-white">
                                <h3>{{ $item->name }}</h3>
                                <a href="{{ $item->link }}">{{_("Click Hare") }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    {{-- <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/001-travel.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about text-white">
                                <h3>Social Media Marketing</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/003-travel-2.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about text-white">
                                <h3>Brand &amp; Logo Design</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/004-travel-3.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about text-white">
                                <h3>Social Media Advertising</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/005-travel-4.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about text-white">
                                <h3>Social Media Advertising</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service d-flex h-100 bg-danger">
                            <div class="svg-icon">
                                <img src="images/flaticon/svg/006-food.svg" alt="Image" class="img-fluid">
                            </div>
                            <div class="service-about text-white">
                                <h3>Web Design / Development</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                    there live the blind texts.</p>
                            </div>
                        </div>
                    </div> --}}

                </div>

            </div>
    </div>

    </section>

    {{-- <section class="site-section bg-light" id="campus-section">
        <div class="container">
            <div class="row">

                <div class="col-12 mb-5 position-relative">
                    <h2 class="section-title text-center mb-5">Campus</h2>
                </div>
                @foreach ($campus as $item)
                <div class="col-md-6 mb-5 mb-lg-0 col-lg-4">
                    <div class="blog_entry">
                        <div class="p-4 bg-white">
                            <h3><a href="{{ $item->link }}">{{ $item->name }}</a></h3>

                        </div>
                    </div>
                </div>
                @endforeach


                <div class="col-md-6 mb-5 mb-lg-0 col-lg-4">
                    <div class="blog_entry">
                        <a href="single.html"><img src="images/blog_2.jpg" alt="Image" class="img-fluid"></a>
                        <div class="p-4 bg-white">
                            <h3><a href="single.html">A small river named Duden flows by their place</a></h3>
                            <span class="date">April 25, 2019</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                            <p class="more"><a href="single.html">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-5 mb-lg-0 col-lg-4">
                    <div class="blog_entry">
                        <a href="single.html"><img src="images/blog_3.jpg" alt="Image" class="img-fluid"></a>
                        <div class="p-4 bg-white">
                            <h3><a href="single.html">A small river named Duden flows by their place</a></h3>
                            <span class="date">April 25, 2019</span>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                            <p class="more"><a href="single.html">Read More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="site-section contact-info" id="contact-section">
        <div class="container p-5 bg-white" style="border-radius: 20px">
            <div class="row">
                <div class="col-12 position-relative">
                    <h2 class="section-title text-center mb-5">Contact Form</h2>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <form id="formprospect">
                        <div class="form-row">
                            <div class=" mb-2 col-md-4"><label for="name">Name </label>
                                <input  type="text" class="form-control" name="name" placeholder=" " required>

                                @error('name') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" mb-2 col-md-4"><label for="tel">Tel no</label>
                                <input type="tel" class="form-control" name="tel" placeholder="0124341455" required pattern="[0-9]{10}">
                                 @error('tel') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" mb-2 col-md-4"> <label for="ic_no">Ic No</label>
                                <input type="text" class="form-control" name="ic_no"
                                    placeholder="991115026225" required pattern="[0-9]{12}">
                               @error('ic_no') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class=" mb-2 col-md-4">   <label for="email">Email</label>
                                <input  type="email" class="form-control" name="email" placeholder=" " required>

                                @error('email') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" mb-2 col-md-4">
                                <label for="gander">Gander</label>
                                <select  name="gander" id="gander" class="form-control"
                                    placeholder=" " required>
                                    <option value="0">Select Gander</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    {{-- <option value="3">EPF, Personal Loan</option> --}}
                                </select>  @error('gander') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" mb-2 col-md-4"><label for="current_status">Curren Status</label>
                                <input type="text" class="form-control" name="current_status"
                                    placeholder=" " required>
                                 @error('current_status') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class=" mb-2 col-md-4"> <label for="current_institution">Current Institution</label>
                                <input type="text" class="form-control"
                                    name="current_institution" id="current_institution" placeholder=" " required>

                                @error('current_institution') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" mb-2 col-md-4">
                                <label for="get_know_obrien">Get know O'berien</label>
                                <select name="get_know_obrien" id="get_know_obrien"
                                    class="form-control" placeholder=" " required>
                                    <option value=" ">Select</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Webinar">Webinar</option>
                                    <option value="Other">Other </option>
                                    {{-- <option value="3">EPF, Personal Loan</option> --}}
                                </select>
                                {{-- <input wire:model="get_know_obrien" type="text" class="form-control" id="get_know_obrien" placeholder=" "> --}}
                                 @error('get_know_obrien') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" mb-2 col-md-4">
                                <label for="funding">Funding</label>
                                <select  name="funding" id="funding" class="form-control"
                                    placeholder=" " required>
                                    <option value=" ">Select</option>
                                    <option value="Self-Funding ( EPF, Personal Loan)">Self-Funding ( EPF, Personal Loan)
                                    </option>
                                    <option value="Sponsored">Sponsored</option>
                                    {{-- <option value="3">EPF, Personal Loan</option> --}}
                                </select>
                                @error('funding') <span
                                        class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                        </div>


                        {{-- <div class="form-group">
                            <label for="programme_id"></label>
                            <input wire:model="programme_id" type="text" class="form-control" id="programme_id"
                                placeholder="Programme Id">@error('programme_id') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="academic_term_id"></label>
                            <input wire:model="academic_term_id" type="text" class="form-control" id="academic_term_id"
                                placeholder="Academic Term Id">@error('academic_term_id') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="status"></label>
                            <input wire:model="status" type="text" class="form-control" id="status"
                                placeholder="Status">@error('status') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                {{-- <button style="float: right" class="btn btn-primary" type="button" id="btnsubmit">Submit</button> --}}
                                <button style="float: right" class="btn btn-primary" type="submit" id="btnsubmit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </section>

    <footer class="site-section bg-light footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-3">
                    <h3 class="footer-title">Official Document</h3>
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="row">
                        @foreach ($officialdocs as $item)
                        <div class="col-lg-4">
                            <h3 class="footer-title"><a href="{{ route('download',$item->url) }}">{{ $item->name }}</a></h3>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="footer-title">Follow Me</h3>
                    <a href="https://web.facebook.com/oba.educ" class="social-circle m-2"><span class="icon-facebook"></span></a>

                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    </div> <!-- .site-wrap -->
    {{-- <div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
            <div class="card-body">
              <h5>
            @guest

				{{ __('Welcome to') }} {{ config('app.name', 'Laravel') }} !!! </br>
				Please contact admin to get your Login Credentials or click "Login" to go to your Dashboard.

			@else
					Hi {{ Auth::user()->name }}, Welcome back to {{ config('app.name', 'Laravel') }}.
            @endif
				</h5>
            </div>
        </div>
    </div>
</div>
</div> --}}
@endsection
