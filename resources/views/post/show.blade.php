@extends('layouts.main')
@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{$post->title}}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200"> • {{$date->translatedFormat('F')}}
                • {{$date->translatedFormat('d')}} • {{$date->translatedFormat('Y')}} • {{$date->format('H:i:s')}}
                • {{$post->comments->count()}} Комментария</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{asset('storage/' . $post->main_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            <div class="row">
                <section>
                    @auth()
                        <form action="{{route('post.like.store',$post->id)}}" method="post">
                            @csrf
                            <span>{{$post->likedUsers()->count()}}</span>
                            <button type="submit" class="border-0 bg-transparent">
                                {{--                                        variant 1--}}
                                {{--                                        @auth()--}}
                                {{--                                            @if(auth()->user()->likedPosts->contains($post->id))--}}
                                {{--                                                <i class="fas fa-heart"></i>--}}
                                {{--                                            @else--}}
                                {{--                                                <i class="far fa-heart"></i>--}}
                                {{--                                            @endif--}}
                                {{--                                        @endauth--}}
                                <i class="fa{{auth()->user()->likedPosts->contains($post->id) ? 's' : 'r'}} fa-heart"></i>

                            </button>
                        </form>
                    @endauth
                        @guest()
                            <div class="class">
                                <span>{{$post->likedUsers()->count()}}</span>
                                <i class="far fa-heart"></i>
                            </div>
                        @endguest

                </section>
                <div class="col-lg-9 mx-auto">
                    @if($relatedPosts->count()>0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Похожие посты</h2>
                            <div class="row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <img src="{{asset('storage/' . $relatedPost->main_image)}}" alt="related post"
                                             class="post-thumbnail">
                                        <p class="post-category">{{$relatedPost->category->title}}</p>
                                        <a href="{{route('post.show', $relatedPost->id)}}"><h5
                                                class="post-title">{{$relatedPost->title}}</h5></a>

                                    </div>
                                @endforeach
                                @endif
                            </div>
                        </section>

                        @auth()
                            <section class="comment-list">
                                <h2 class="section-title mb-5" data-aos="fade-up">Комментарии
                                    ({{$post->comments->count()}}
                                    )</h2>
                                @foreach($post->comments as $comment)
                                    <div class="comment-text  mb-4">
                            <span class="username">
                                <div class="font-weight-bold text-uppercase ">{{auth()->user()->name}}</div>
                              <span class="text-muted float-right">{{$comment->dateAsCarbon->diffForHumans()}}</span>
                            </span><!-- /.username -->
                                        {{$comment->message}}
                                    </div>
                                @endforeach
                            </section>
                        @endauth


                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Отправить комментарий</h2>
                            <form action="{{route('post.comment.store', $post->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Comment</label>
                                        <textarea name="message" id="comment" class="form-control"
                                                  placeholder="Оставьте комментарий"
                                                  rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Отправить" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                </div>
            </div>
        </div>
    </main>
@endsection

