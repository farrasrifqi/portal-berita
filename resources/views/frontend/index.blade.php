@extends('frontend.parent')

@section('content')
    <h3 class="category-title">Berita Zenblog</h3>

    <div class="col-12">
        <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">

                @foreach ($slider as $row)
                    <div class="swiper-slide">
                        <a href="{{ $row->url }}" class="img-bg d-flex align-items-end"
                            style="background-image: url('{{ $row->image }}');">
                            <div class="img-bg-inner">
                                {{-- <h2>Tugas Skl</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia!
                                    Beatae
                                    minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime
                                    inventore repudiandae quidem necessitatibus rem atque.</p> --}}
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>


    @forelse ($news as $row)
        <div class="d-md-flex post-entry-2 small-img mt-4   ">
            <a href="{{ route('detailNews', $row->slug) }}" class="me-4 thumbnail">
                <img src="{{ $row->image }}" alt="" class="img-fluid">
            </a>
            <div>
                <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span
                        class="mx-1">&bullet;</span>
                    <span>{{ $row->created_at }}</span>
                </div>
                <h3>
                    <a href="{{ route('detailNews', $row->slug) }}">{{ $row->title }} </a>
                </h3>
                <p>
                    {!! Str::words($row->description, '13') !!}

                </p>
                <div class="d-flex align-items-center author">
                    <div class="photo"><img src="{{ asset('admin/assets/img/nft.jpg') }}" alt=""
                            class="img-fluid">
                    </div>
                    <div class="name">
                        <h3 class="m-0 p-0">theking</h3>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Tidak ada berita
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforelse


    <!-- Paging -->
    <div class="text-start py-4">
        <div class="custom-pagination">
            <a href="#" class="prev">Prevous</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="next">Next</a>
        </div>
    </div><!-- End Paging -->
@endsection
