@foreach ($categories as $category)
    <div class="row mb-5">
        <div class="tt-title text-center w-100 mb-3">
            {{ $category->category_name }}
        </div>

        @if ($category->products->count())
            <div class="tab-content w-100">
                <div class="tab-pane active w-100" id="ttfeatured-main-{{ $category->category_id }}" role="tabpanel">
                    <section class="ttfeatured-products">
                        <div class="ttfeatured-content products grid owl-carousel">
                            @foreach ($category->products as $product)
                                <div class="product-thumb p-2 d-flex flex-column align-items-center ">
                                    <div class="image zoom">
                                        <a href="{{ route('product.details', $product->product_id) }}">
                                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->pname }}"
                                                class="img-fluid" />
                                        </a>
                                    </div>
                                    <div
                                        class="thumb-description d-flex flex-column flex-grow-1 justify-content-end text-center w-100">
                                        <div class="caption">
                                            <h4 class="product-title text-capitalize">
                                                <a href="{{ route('product.details', $product->product_id) }}">
                                                    {{ $product->pname }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="price">
                                            <div class="regular-price">
                                                ${{ number_format($product->current_price, 2) }}
                                            </div>
                                            <div class="old-price">
                                                ${{ number_format($product->old_price, 2) }}
                                            </div>
                                        </div>
                                        <div class="button-wrapper">
                                            <div class="button-group text-center">
                                                <form action="{{ route('product.show', $product->product_id) }}" method="get">
                                                    <button type="submit" class="btn btn-primary btn-cart">
                                                        <i class="material-icons">shopping_cart</i>
                                                        <span>Detail</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        @else
            <p class="text-center">Không có sản phẩm nào.</p>
        @endif
    </div>
    <script>
        window.addEventListener('load', function () {
            // Lấy tất cả các card sản phẩm
            const productThumbs = document.querySelectorAll('.product-thumb');
            let maxImageHeight = 0;

            // Duyệt qua từng sản phẩm để đo chiều cao của phần ảnh
            productThumbs.forEach(thumb => {
                // Giả sử phần chứa ảnh có class "image"
                const imageDiv = thumb.querySelector('.image');
                if (imageDiv) {
                    // Đo chiều cao của phần ảnh (bạn có thể lấy từ img nếu muốn)
                    const currentHeight = imageDiv.offsetHeight;
                    if (currentHeight > maxImageHeight) {
                        maxImageHeight = currentHeight;
                    }
                }
            });

            // Sau khi có chiều cao lớn nhất, gán cho mỗi .image
            productThumbs.forEach(thumb => {
                const imageDiv = thumb.querySelector('.image');
                if (imageDiv) {
                    imageDiv.style.height = maxImageHeight + 'px';
                }
            });

            // Nếu muốn toàn bộ card có chiều cao nhất định (hình ảnh + phần description cố định)
            // Ví dụ description có chiều cao 100px (bao gồm padding, margin, …)
            // Bạn có thể đặt min-height cho .product-thumb như sau:
            const descHeight = 100; // điều chỉnh lại nếu cần
            productThumbs.forEach(thumb => {
                thumb.style.minHeight = (maxImageHeight + descHeight) + 'px';
            });
        });
    </script>
    <style>
        .btn.btn-primary.btn-cart:hover {
            background-color: rgb(106, 80, 31) !important;
            border-color: gray !important;
            color: #fff !important;
        }
    </style>

@endforeach