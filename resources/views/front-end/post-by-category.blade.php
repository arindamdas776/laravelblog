@extends('front-end.app')

@section('title','post title')

@push('css')

@endpush

@section('content')
    <section class="blog-area section">
        <div class="container">

            <div class="row">

                @if($category->post->count() >0)

                @foreach($category->post as $row)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ asset('storage/post/'.$row->image) }}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$row->user->image) }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details',$row->slug) }}"><b>{{$row->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        <li><a href="#"><i class="ion-heart"></i>{{ $row->user_to_favorite_post->count() }}</a></li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{$row->view_count}}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach

                    @else
                <p class="text-center"><strong>Sorrry No post found :-(</strong></p>

              @endif

            </div><!-- row -->



        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')

@endpush
