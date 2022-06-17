<!doctype html>
<html class="no-js" lang="zxx">
   <head>
        @include('frontend.layouts.head')
   </head>
   <body>
  
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            @include('frontend.layouts.header')
            <!-- Header Area End Here -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('backend.layouts.notification')
                    </div>
                </div>
            </div>

            @yield('content')
        <!-- Body Wrapper End Here -->
            @include('frontend.layouts.footer')
            
            @include('frontend.layouts.script')
        </div>
    </body>

<!-- index-431:47-->
</html>
