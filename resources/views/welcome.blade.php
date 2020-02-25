@extends('front-end.app')

@section('title','Blog')

@push('css')

@endpush

@section('content')
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
         data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
         data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach($category as $row)
                <div class="swiper-slide">
                    <a class="slider-category" href="{{ route('post.category',$row->slug) }}">
                        <div class="blog-image"><img src="{{ asset('storage/category/'.$row->image) }}"alt="{{$row->name}}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{$row->name}}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->
            @endforeach


        </div><!-- swiper-wrapper -->
    </div>

    <section class="blog-area section">
        <div class="container">

            <div class="row">

          @foreach($post as $row)

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ asset('storage/post/'.$row->image) }}" alt="Blog Image"></div>

                            <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$row->user->image) }}" style="height:100%;width:100%" alt="Profile Image"></a>
                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details',$row->slug) }}">{{ $row->title }}<b></b></a></h4>

                                <ul class="post-footer">
                                    <li>

                                 @guest
                                            <a href="#" onclick="
                                toastr.error('You need To login first',{
                                    progressBar:true,
                                    closeButton:true,
                                })
                            "><i class="ion-heart"></i>{{ $row->user_to_favorite_post->count() }}</a>
                                     @else
                                            <a href="#" onclick="
                                        document.getElementById('like-post-{{ $row->id }}').submit();
                        "><i class="ion-heart"></i>{{ $row->user_to_favorite_post->count() }}</a>
                                 @endguest
                                        <form method="post" action="{{ route('post.add',$row->id) }}"id="like-post-{{ $row->id }}"style="display:none;" >
                                            @csrf
                                        </form>

                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $row->view_count }}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

          @endforeach
            </div><!-- row -->

            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')

@endpush
