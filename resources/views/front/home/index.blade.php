@extends('front.common.layout')
@section('content')
    <!--/ Intro Skew Star /-->
    <div id="home" class="intro route bg-image" style="background-image: url(frontend/img/images6.jpg)">
        <div class="overlay-itro"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <!--<p class="display-6 color-d">Hello, world!</p>-->
                    <h1 class="intro-title mb-4">I am KaruNa Sapkota</h1>
                    <p class="intro-subtitle"><span class="text-slider-items"> KaruNA,Web Developer,Web Designer,Frontend Developer,Graphic Designer</span><strong class="text-slider"></strong></p>
                    <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Intro Skew End /-->
    @if(isset($data['about']) && $data['about'])
    <section id="about" class="about-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-shadow-full">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6 col-md-5">
                                        <div class="about-img">
                                            @if($data['about']->photo)
                                                <img src="{{asset('images/aboutUs/'.$data['about']->photo)}}"
                                                     alt="{{$data['about']->name}}" class="img-fluid rounded b-shadow-a" alt="">
                                            @else
                                                No Image
                                            @endif
{{--                                            <img src="img/testimonial-2.jpg" class="img-fluid rounded b-shadow-a" alt="">--}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-7">
                                        <div class="about-info">
                                            <p><span class="title-s">Name: </span> <span>{{ $data['about']->name }}</span></p>
                                            <p><span class="title-s">Profile: </span> <span>{{ $data['about']->profile }}</span></p>
                                            <p><span class="title-s">Email: </span> <span>{{ $data['about']->email }}</span></p>
                                            <p><span class="title-s">Phone: </span> <span>{{ $data['about']->phone }}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="skill-mf">
                                    <p class="title-s">Skill</p>
                                    @if(isset($data['skills']) && $data['skills']->count() > 0)
                                        @foreach($data['skills'] as $skill)
                                            <span>{{ $skill->title }}</span> <span class="pull-right">{{ $skill->percent }}%</span>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="{{ $skill->percent }}" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        @endforeach
                                    @else
                                    <span>Updating Skill Soon</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-me pt-4 pt-md-0">
                                    <div class="title-box-2">
                                        <h5 class="title-left">
                                            About me
                                        </h5>
                                    </div>
                                    {!! Str::limit($data['about']->description,1250) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--/ Section Services Star /-->
    <section id="service" class="services-mf route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Services
                        </h3>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($data['services']) && $data['services']->count() > 0)
                    @foreach($data['services'] as $service)
                        <div class="col-md-4">
                            <div class="service-box">
                                <div class="service-ico text-center">
                                    @if($service->photo)
                                        <img src="{{asset('images/services/'.$service->photo)}}"
                                             alt="{{$service->title}}" width="50%" height="100%"
                                             style="max-height: 150px;
                                              box-shadow: 0 0 0 10px #0078ff;
                                                border-radius: 100px">
                                    @else
                                        No Existing Image
                                    @endif
{{--                                    <span class="ico-circle">--}}
{{--                                        <i class="ion-monitor"></i>--}}

{{--                                    </span>--}}
                                </div>
                                <div class="service-content">
                                    <h2 class="s-title">{{ $service->title }}</h2>
                                    <p class="s-description text-center">
                                        {!! Str::limit($service->description,250) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <span>Updating Services Soon</span>
                @endif

            </div>
        </div>
    </section>
    <!--/ Section Services End /-->

{{--    <div class="section-counter paralax-mf bg-image" style="background-image: url(img/counters-bg.jpg)">--}}
{{--        <div class="overlay-mf"></div>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3 col-lg-3">--}}
{{--                    <div class="counter-box">--}}
{{--                        <div class="counter-ico">--}}
{{--                            <span class="ico-circle"><i class="ion-checkmark-round"></i></span>--}}
{{--                        </div>--}}
{{--                        <div class="counter-num">--}}
{{--                            <p class="counter">450</p>--}}
{{--                            <span class="counter-text">WORKS COMPLETED</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3 col-lg-3">--}}
{{--                    <div class="counter-box pt-4 pt-md-0">--}}
{{--                        <div class="counter-ico">--}}
{{--                            <span class="ico-circle"><i class="ion-ios-calendar-outline"></i></span>--}}
{{--                        </div>--}}
{{--                        <div class="counter-num">--}}
{{--                            <p class="counter">15</p>--}}
{{--                            <span class="counter-text">YEARS OF EXPERIENCE</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3 col-lg-3">--}}
{{--                    <div class="counter-box pt-4 pt-md-0">--}}
{{--                        <div class="counter-ico">--}}
{{--                            <span class="ico-circle"><i class="ion-ios-people"></i></span>--}}
{{--                        </div>--}}
{{--                        <div class="counter-num">--}}
{{--                            <p class="counter">550</p>--}}
{{--                            <span class="counter-text">TOTAL CLIENTS</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3 col-lg-3">--}}
{{--                    <div class="counter-box pt-4 pt-md-0">--}}
{{--                        <div class="counter-ico">--}}
{{--                            <span class="ico-circle"><i class="ion-ribbon-a"></i></span>--}}
{{--                        </div>--}}
{{--                        <div class="counter-num">--}}
{{--                            <p class="counter">36</p>--}}
{{--                            <span class="counter-text">AWARD WON</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!--/ Section Portfolio Star /-->
    <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Portfolio
                        </h3>
                        <p class="subtitle-a">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </p>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($data['works']) && $data['works']->count() > 0)
                    @foreach($data['works'] as $work)
                        <div class="col-md-4">
                            <div class="work-box">
                                <a href="{{asset('images/work/'.$work->photo)}}" data-lightbox="gallery-mf">
                                    <div class="work-img">
                                        <img src="{{asset('images/work/'.$work->photo)}}" alt=""
                                             style="max-height: 300px; max-width: 300px "  class="img-fluid">
                                    </div>
                                    <div class="work-content">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2 class="w-title">{{$work->title}}</h2>
                                                <div class="w-more">
                                                    <span class="w-ctegory">{{ $work->sub_title }}</span> / <span class="w-date">18 Sep. 2018</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w-like">
                                                    <span class="ion-ios-plus-outline"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="card-body">
                            <span class="text-center">Updating Soon......</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--/ Section Portfolio End /-->

    <!--/ Section Testimonials Star /-->
    <div class="testimonials paralax-mf bg-image" style="background-image: url(img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="testimonial-mf" class="owl-carousel owl-theme">
                        @if(isset($data['users']) && $data['users']->count() > 0)
                            @foreach($data['users'] as $user)
                        <div class="testimonial-box">
                            <div class="author-test">
                                <img src="{{asset('images/user/'.$user->photo)}}" style="width:100px;height:85px;"alt="" class="rounded-circle b-shadow-a">
                                <span class="author">{{ $user->name }}</span>
                            </div>
                            <div class="content-test">
                                <p class="description lead">{{ $user->description }}

                                </p>
                                <span class="comit"><i class="fa fa-quote-right"></i></span>
                            </div>
                        </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="card-body">
                                    <span class="text-center">Updating Soon......</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--/ Section Blog Star /-->
    <section id="blog" class="blog-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Blog
                        </h3>
                        <p class="subtitle-a">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </p>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($data['blogs']) && $data['blogs']->count() >0)
                    @foreach($data['blogs'] as $blog)
                        <div class="col-md-4">
                            <div class="card card-blog">
                                <div class="card-img">
                                    <a href="{{ route('blog',$blog->slug) }}">
                                        <img src="{{asset('images/blog/'.$blog->photo)}}" alt="" style="max-height: 200px;width: 100%; object-fit: cover" class="img-fluid"></a>
                                </div>
                                <div class="card-body">
                                    <div class="card-category-box">
                                        <div class="card-category">
                                            <h6 class="category">{{ $blog->sub_title }}</h6>
                                        </div>
                                    </div>
                                    <h3 class="card-title"><a href="{{ route('blog',$blog->slug) }}">{{ $blog->title }}</a></h3>
                                    <p class="card-description">
                                        {!! Str::limit($blog->description,240) !!}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="post-author">
                                        <a href="#">
                                            <img src="{{asset('images/user/'.$user->photo)}}" alt="" class="avatar rounded-circle">
                                            <span class="author">{{ $user->name }}</span>
{{--                                            <span class="author">{{$blog->author}}</span>--}}
                                        </a>
                                    </div>
                                    <div class="post-date">
                                        <span class="ion-ios-clock-outline"></span>
                                        {{ $blog->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @endif

            </div>
        </div>
    </section>
    <!--/ Section Blog End /-->

    <!--/ Section Contact-Footer Star /-->
    <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-mf">
                        <div id="contact" class="box-shadow-full">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title-box-2">
                                        <h5 class="title-left">
                                            Send Message Us
                                        </h5>
                                    </div>
                                    <div>
                                        <form action="{{route('contact.store')}}" method="post" role="form" class="contactForm">
                                            @csrf
                                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                                            <div id="errormessage"></div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="button button-a button-big button-rouded">Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title-box-2 pt-4 pt-md-0">
                                        <h5 class="title-left">
                                            Get in Touch
                                        </h5>
                                    </div>
                                    <div class="more-info">
                                        <p class="lead">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis dolorum dolorem soluta quidem
                                            expedita aperiam aliquid at.
                                            Totam magni ipsum suscipit amet? Autem nemo esse laboriosam ratione nobis
                                            mollitia inventore?
                                        </p>
                                        <ul class="list-ico">
                                            <li><span class="ion-ios-location"></span> Bagmati Province, Banepa 8 Kavrepalanchowk,Nepal </li>
                                            <li><span class="ion-ios-telephone"></span> +977 9843374627</li>
                                            <li><span class="ion-email"></span> karuna.itb@gmail.com</li>
                                        </ul>
                                    </div>
                                    <div class="socials">
                                        <ul>
                                            <li><a href=""><span class="ico-circle"><i class="ion-social-facebook"></i></span></a></li>
                                            <li><a href=""><span class="ico-circle"><i class="ion-social-instagram"></i></span></a></li>
                                            <li><a href=""><span class="ico-circle"><i class="ion-social-twitter"></i></span></a></li>
                                            <li><a href=""><span class="ico-circle"><i class="ion-social-pinterest"></i></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="copyright-box">
                            <p class="copyright">&copy; Copyright <strong>KaruNa</strong>. All Rights Reserved</p>
                            <div class="credits">
                                <!--
                                  All the links in the footer should remain intact.
                                  You can delete the links only if you purchased the pro version.
                                  Licensing information: https://bootstrapmade.com/license/
                                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
                                -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!--/ Section Contact-footer End /-->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>

@endsection
