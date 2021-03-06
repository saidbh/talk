<!doctype html>
<html lang="en">
@include('admin.partials._body_style')
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
        <div class="loader">
            <div class="cube">
                <div class="sides">
                    <div class="top"></div>
                    <div class="right"></div>
                    <div class="bottom"></div>
                    <div class="left"></div>
                    <div class="front"></div>
                    <div class="back"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- loader END -->
@include('admin.partials._app_body')
</body>
@include('admin.partials._body_scripts')
</html>
