<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('components.users.dashboardlink')
</head>
@include('components.users.header')

<body>
    <div class="main-content w-100 float-left">
        <div class="container">
            <div class="row">
                <!--Google map-->
                <div id="map-container-google-1" class="z-depth-1-half map-container col-sm-12 mb-50"
                    style="height: 500px">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d256066.07719595975!2d105.55041739453127!3d21.00876610000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab448047b809%3A0x2644a6ab0e10877d!2sRhodi%20shop!5e1!3m2!1svi!2s!4v1745876372095!5m2!1svi!2s"
                        width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </iframe>

                </div>
                <!--Google Maps-->
                <div class="contact-form-area col-sm-7">
                    <div class="contact-form-inner">
                        <h4 class="text-capitalize">tell us your project</h4>
=   
                    </div>
                </div>
                <div class="contact-address col-sm-5">
                    <div class="contact-inner float-left w-100">
                        <div class="contact-information">
                            <h4 class="text-capitalize">contact us</h4>

                            <p>Rhodi Shop - một brand thời trang nam tại Hà Nội, được thành lập vào năm 2013. Sau hơn
                                chục năm phát triển, Rhodi hiện đang hoạt động với 2 cở sở chính tại Hà Nội và các nền
                                tảng mạng xã hội. Rhodi coi trọng trải nghiệm khách hàng, tinh thần của con người và đưa
                                đến những sản phẩm giá thành hợp lý hơn bất kì chiến dịch quảng bá nào khác</p>
                            <div class="contact-wrapper">
                                <div class="contact-list">
                                    <i class="material-icons">place</i>
                                    <span>Address : 365 Trần Khát Chân - Hà Nội</span>
                                </div>
                                <div class="contact-list">
                                    <i class="material-icons">call</i>
                                    <span>0934591228</span>
                                </div>
                                <div class="contact-list">
                                    <i class="material-icons">email</i>
                                    <span> rhodishop@gmail.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="working-time">
                            <h5>Working hours</h5>
                            <div>
                                <div>Monday – Sunday</div>
                                <div>08:30AM – 22:00PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('components.users.footer')

</html>