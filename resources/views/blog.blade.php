@extends('layout.otherMaster')
@push('banner_img','images/bg_1.jpg')
@push('banner_title','Blog')

@section('content')

    <section class="ftco-section ftco-degree-bg">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                        <form action="{{ url('/search') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control" name="search_value" placeholder="Search..."> &nbsp;&nbsp; <input type="submit" class="btn btn-outline-secondary btn-md" name="Search" value="Search">
                        </form>
                        </div>
                        @foreach($posts as $post)
                        <div class="col-md-12 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <a href="{{ route('blogView',$post->id) }}" class="block-20" style="background-image: url('/images/{{ $post->image }}');">
                                </a>
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><a href="#"><span class="icon-calendar"></span> {{ $post->created_at->diffforHumans() }}</a></div>

                                        <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }}</a></div>

                                        <div><a href="#" class="meta-chat"><span class="icon-chat"></span> {{ $post->comment->count() }}</a></div>
                                    </div>
                                    <h3 class="heading"><a href="{{ route('blogView',$post->id) }}">{{ $post->title }}</a></h3>
                                    <p>{!! \Illuminate\Support\Str::limit(strip_tags($post->details),100) !!}</p>
                                    <p><a href="{{ route('blogView',$post->id) }}" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $posts->links() }}

                    </div>
                </div> <!-- .col-md-8 -->






                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
{{--                                <span class="icon ion-ios-search"></span>--}}
{{--                                <form action="{{ url('/search') }}" method="GET">--}}
{{--                                    <input type="text" class="form-control" name="search_value" placeholder="Search...">--}}
{{--                                    <input type="submit" class="btn btn-sm" name="Search" value="Search" >--}}
{{--                                </form>--}}
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Vegetables <span>(12)</span></a></li>
                            <li><a href="#">Fruits <span>(22)</span></a></li>
                            <li><a href="#">Juice <span>(37)</span></a></li>
                            <li><a href="#">Dries <span>(42)</span></a></li>
                        </ul>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Recent Blog</h3>

                        @foreach($posts as $post)
                        <div class="block-21 mb-4 d-flex">
                            <a href="{{ route('blogView',$post->id) }}" class="blog-img mr-4" style="background-image: url('/images/{{ $post->image }}');"></a>
                            <div class="text">
                                <h3 class="heading-1"><a href="{{ route('blogView',$post->id) }}">{{ $post->title }}</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> {{ $post->created_at->diffforHumans() }}</a></div>
                                    <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }}</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> {{ $post->comment->count() }}</a></div>
                                </div>
                            </div>
                        </div>
                        @endforeach




                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Tag Cloud</h3>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">fruits</a>
                            <a href="#" class="tag-cloud-link">tomatoe</a>
                            <a href="#" class="tag-cloud-link">mango</a>
                            <a href="#" class="tag-cloud-link">apple</a>
                            <a href="#" class="tag-cloud-link">carrots</a>
                            <a href="#" class="tag-cloud-link">orange</a>
                            <a href="#" class="tag-cloud-link">pepper</a>
                            <a href="#" class="tag-cloud-link">eggplant</a>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->


@endsection

