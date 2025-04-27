<?php
namespace App\Services;
use Illuminate\Support\Str;
class FormatService
{
   
    // Hàm chuyển đổi số thành tiền tệ Việt Nam
    public function currencyVN($amount, $decimals = 3): string
    {
        return number_format($amount, decimals: $decimals, decimal_separator: ',', thousands_separator: '.') . ' ₫';
    }

    // Hàm tạo mã sản phẩm

    // public function generateProductCode(string $name, string $brand, string $size, string $color): string
    // {
    //     // Hàm slugify để loại bỏ dấu, khoảng trắng, ký tự đặc biệt
    //     $slugify = function ($text) {
    //         $text = strtolower($text);
    //         $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text); // bỏ dấu tiếng Việt
    //         $text = preg_replace('/[^a-z0-9]/', '', $text); // chỉ giữ chữ và số
    //         return $text;
    //     };

    //     return $slugify($name) . $slugify($brand) . $slugify($size) . $slugify($color);
    // }



      /**
     * Tạo mã sản phẩm từ tên, thương hiệu, size, màu sắc
     *
     * @param string $name
     * @param string $brand
     * @param string $size
     * @param string $color
     * @return string
     */
    public function generateProductCode($name, $brand, $size, $color)
    {
        // Viết tắt 3 chữ cái đầu của tên và thương hiệu, xóa khoảng trắng
        $namePart  = strtoupper(substr(preg_replace('/\s+/', '', $name), 0, 3));
        $brandPart = strtoupper(substr(preg_replace('/\s+/', '', $brand), 0, 3));
        $sizePart  = strtoupper(str_replace(' ', '', $size)); 
        $colorPart = strtoupper(str_replace(' ', '', $color));

        // Tạo mã sản phẩm: NAME-BRAND-SIZE-COLOR-RANDOM
        return sprintf("%s-%s-%s-%s-%03d", $namePart, $brandPart, $sizePart, $colorPart, rand(100, 999));
    }
}



?>
<!-- Hàm chuyển tên và size và màu thành mã sản phẩm khi chưa add sản phẩm mới  -->
<script>

function generateProductCode(productNameId, brandId, sizeId, colorId, outputId) {
    // Lấy giá trị từ các trường nhập liệu
    const productName = document.getElementById(productNameId).value;
    const brand = document.getElementById(brandId).value;
    const size = document.getElementById(sizeId).value;
    const color = document.getElementById(colorId).value;

    // Chuyển đổi tên sản phẩm thành không dấu, viết thường và không có khoảng trắng
    const slugify = (text) => {
        return text
            .toString()
            .toLowerCase()
            .replace(/\s+/g, '') // Xóa khoảng trắng
            .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ cái, số hoặc dấu gạch ngang
            .replace(/\-\-+/g, '-') // Thay thế nhiều dấu gạch ngang bằng một dấu gạch ngang
            .replace(/^-+/, '') // Xóa dấu gạch ngang ở đầu
            .replace(/-+$/, ''); // Xóa dấu gạch ngang ở cuối
    };

    // Tạo mã sản phẩm
    const productCode = slugify(productName) + slugify(brand) + slugify(size) + slugify(color);

    // Cập nhật giá trị vào trường mã sản phẩm
    document.getElementById(outputId).value = productCode;
}

// Hàm để thiết lập lắng nghe sự kiện cho các trường
function setupProductCodeGeneration(productNameId, brandId, sizeId, colorId, outputId) {
    document.getElementById(productNameId).addEventListener('input', () => generateProductCode(productNameId, brandId, sizeId, colorId, outputId));
    document.getElementById(brandId).addEventListener('input', () => generateProductCode(productNameId, brandId, sizeId, colorId, outputId));
    document.getElementById(sizeId).addEventListener('input', () => generateProductCode(productNameId, brandId, sizeId, colorId, outputId));
    document.getElementById(colorId).addEventListener('input', () => generateProductCode(productNameId, brandId, sizeId, colorId, outputId));
}




</script>