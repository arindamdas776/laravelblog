@extends('front-end.app')

@section('title','All post view')

@push('css')

@endpush

@section('content')

    <section class="blog-area section">
        <div class="container">

            <div class="row">
        @foreach($post as $row)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><a href="{{ route('post.details',$row->slug) }}"><img src="{{ asset('storage/post/'.$row->image) }}" alt="Blog Image"></a></div>

                                <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$row->user->image) }}" style="height:100%; width:100%;" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details',$row->slug) }}"><b>{{ $row->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li><a href="#" onclick="
                                document.getElementById('like-post-{{ $row->id }}').submit();
                        "><i class="ion-heart"></i>{{ $row->user_to_favorite_post->count() }}</a>
                                        <form method="post" action="{{ route('post.add',$row->id) }}" id="like-post-{{ $row->id }}">
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
