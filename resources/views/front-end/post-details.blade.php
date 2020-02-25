@extends('front-end.app')

@section('title','post-details')

@push('css')
    <link href="{{ asset('front-end/css/post-details/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/css/post-details/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="slider">

    </div><!-- slider -->


    <section class="post-area">
        <div class="container">

            <div class="row">

                <div class="col-lg-1 col-md-0"></div>
                <div class="col-lg-10 col-md-12">

                    <div class="main-post">

                        <div class="post-top-area">

                            <h5 class="pre-title">{{ $post->title }}</h5>

                            <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$post->user->image) }}" style="width:100%;height:100px;" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date">{{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p class="para">{!! $post->body !!}</p>

                        </div><!-- post-top-area -->

                        <div class="post-image"><img src="{{ asset('storage/post/'.$post->image) }}" alt="Blog Image"></div>

                        <div class="post-bottom-area">

                            <p class="para">{!! $post->body !!}</p>

                            <ul class="tags">
                          @foreach($post->category as $row)
                                    <li><a href="#">{{ $row->name }}</a></li>
                          @endforeach

                            </ul>

                            <div class="post-icons-area">
                                <ul class="post-icons">
                                    <li>
                                        <a onclick="
                                    document.getElementById('like-post-{{ $post->id }}').submit();
                            "><i class="ion-heart"></i>{{$post->user_to_favorite_post->count()}}</a>
                                        <form method="post" action="{{ route('post.add',$post->id) }}" id="like-post-{{ $post->id }}" style="display:none;">
                                            @csrf
                                        </form>
                                    </li>
                                    <li><a ><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>

                                <ul class="icons">
                                    <li>SHARE : </li>
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                </ul>
                            </div>

                            <div class="post-footer post-info">

                                <div class="left-area">

                                </div>

                                <div class="middle-area">

                                </div>

                            </div><!-- post-info -->

                        </div><!-- post-bottom-area -->

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- post-area -->

    <section class="recomended-area section">
        <div class="container">
            <div class="row">
        @foreach($random_post as $row)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ asset('storage/post/'.$row->image) }}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$row->user->image) }}" style="width:100%;height:100px;" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="#"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex
                                                Concepts in Physics?</b></a></h4>

                                    <ul class="post-footer">
                                        <li> <a href="#" onclick="
                                                document.getElementById('like-post-{{ $row->id }}').submit();
                                                "><i class="ion-heart"></i>{{ $row->user_to_favorite_post->count() }}</a>
                                            <form method="post" action="{{ route('post.add',$row->id) }}"id="like-post-{{ $row->id }}"style="display:none;" >
                                                @csrf
                                            </form>

                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
        @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>


    <section class="comment-section center-text">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-2 col-md-0"></div>

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post" action="{{ route('comment.store',$post->id) }}">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12">
									<textarea  name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{ $post->user_to_favorite_post->count() }})</b></h4>

                @foreach($post->comment as $row)
                        <div class="commnets-area text-left">

                            <div class="comment">

                                <div class="post-info">

                                    <div class="left-area">
                                        <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$row->user->image) }}" style="height:100px; width:100%;" alt="Profile Image"></a>
                                    </div>

                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{ $row->user->name }}</b></a>
                                        <h6 class="date">{{ $row->created_at->diffForHumans() }}</h6>
                                    </div>

                                    <div class="right-area">
                                        <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                    </div>

                                </div><!-- post-info -->

                                <p>{{ $row->comment }}</p>

                            </div>

                        </div><!-- commnets-area -->

                    @endforeach

                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush
