@extends('layout.otherMaster')
@push('banner_img'){{ asset('images/bg_1.jpg') }}@endpush
@push('banner_title','products')

@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="#" class="active">All</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruits</a></li>
                        <li><a href="#">Juice</a></li>
                        <li><a href="#">Dried</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="{{ route('productView',$product->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset('images/'.$product->pro_img) }}" alt="Colorlib Template">
                            <span class="status">30%</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="{{ route('productView',$product->id) }}">{{ $product->pro_name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price-dc">$120</span><span class="price-sale">${{ $product->pro_price }}</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="{{ route('productView',$product->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="{{ route('cartAdd',$product->id) }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach





            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            {{ $products->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')

    <style>
        .page-link{
            padding: 0px;
        }
        .page-item.active .page-link {
            background-color: #82AE46;
            border-color: #82AE46;
        }
    </style>
    @endpush