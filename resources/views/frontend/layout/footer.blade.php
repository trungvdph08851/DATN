
<footer class="footer-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-8">
                <div class="single-footer-widget">
                    <img src="{{ asset($setting->logo) }}" alt="image" width="160px" />
                    <p class="mt-2">Hệ thống Nha khoa Đông Anh đã trải qua nhiều năm hình thành và phát triển, đã được hàng triệu khách hàng tin tưởng.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-8" style="width: 290px;">
                <div class="single-footer-widget">
                    <h3 style="margin-bottom: 15px; font-size: 23px">LIÊN HỆ</h3>
                    <ul class="quick-links" style="font-size: 16px">
                        <?php echo $setting->contact_information ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-8"style="width: 220px;margin-left: 30px;">
                <div class="single-footer-widget">
                    <h3 style="margin-bottom: 15px; font-size: 23px">Dịch vụ</h3>
                    <ul class="quick-links">
                        @foreach ($servicess as $item)
                            <a href="{{ route('service_detail', ['id' => $item->id])}}" style="color: white">{{$item->name}}</a></br>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-8 single-footer-widget">
                <h3>Google Map</h3>
                <?php echo $setting->google_map ?>
            </div>

        </div>
    </div>
</footer>
<div class="go-top">
    <i class='bx bx-up-arrow-alt'></i>
</div>
{{--1--}}
