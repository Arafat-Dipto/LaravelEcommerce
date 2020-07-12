@extends('layout.otherMaster')
@push('banner_img'){{ asset('images/bg_1.jpg') }}@endpush
@push('banner_title','Blog')

@section('content')

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $post->title }}</h2>

                    <p>
                        <img src="/images/{{ $post->image }}" alt="" class="img-fluid">
                    </p>
                    <p>{!! $post->details !!}</p>



                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">Life</a>
                            <a href="#" class="tag-cloud-link">Sport</a>
                            <a href="#" class="tag-cloud-link">Tech</a>
                            <a href="#" class="tag-cloud-link">Travel</a>
                        </div>
                    </div>

                    <div class="about-author d-flex p-4 bg-light">
                        <div class="bio align-self-md-center mr-4">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                        </div>
                        <div class="desc align-self-md-center">
                            <h3>Lance Smith</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                        </div>
                    </div>




                    <div class="pt-5 mt-5">
                        <h3>6 Comments</h3>

                        <div class="comment-form-wrap pt-5">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <h3 class="mb-5">Leave a comment</h3>
                                <form action="{{ url('/comment') }}" method="POST" class="p-5 bg-light">
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <label for="message">Message</label>
                                        <textarea name="comment" id="comment" cols="40" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                                    </div>

                                </form>
                            @endif
                        </div>


                        @forelse($comments as $comment)
                        <ul class="comment-list">
                            <li class="comment mt-5">
                                <div class="vcard bio">
                                    <img src="{{ asset('images/person_1.jpg') }}" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>{{ $comment->user->name }}</h3>
                                    <div class="meta">{{ $comment->created_at->diffforHumans() }}
                                        @if(\Illuminate\Support\Facades\Auth::id() == $comment->user->id)
                                        &nbsp;&nbsp;&nbsp;<a href="{{ route('user.commentEditShow',$comment->id) }}">Edit</a>
                                            &nbsp;<a style="color: red;" onclick="return confirm('want to delete this comment?');" href="{{ route('user.commentDelete',$comment->id) }}">Delete</a>
                                        @endif
                                    </div>
                                    <p>{{ $comment->comment }}</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>

                                <ul class="children">
                                    <li class="comment">
                                        <div class="vcard bio">
                                            <img src="images/person_1.jpg" alt="Image placeholder">
                                        </div>
                                        <div class="comment-body">
                                            <h3>John Doe</h3>
                                            <div class="meta">June 27, 2018 at 2:21pm</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                            <p><a href="#" class="reply">Reply</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        @empty
                            <p class="mt-5"><b>No comments yet</b></p>
                        @endforelse
                        <!-- END comment-list -->




                    </div>
                </div> <!-- .col-md-8 -->


                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Search...">
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

                        @foreach($posts as $p)
                            <div class="block-21 mb-4 d-flex">
                                <a href="{{ route('blogView',$p->id) }}" class="blog-img mr-4" style="background-image: url('/images/{{ $p->image }}');"></a>
                                <div class="text">
                                    <h3 class="heading-1"><a href="{{ route('blogView',$p->id) }}">{{ $p->title }}</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span> {{ $p->created_at->diffforHumans() }}</a></div>
                                        <div><a href="#"><span class="icon-person"></span> {{ $p->user->name }}</a></div>
                                        <div><a href="#"><span class="icon-chat"></span> {{ $p->comment->count() }}</a></div>
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