 @extends('layout.index')

 @section('content')
 <!-- Page Content -->
    <div class="container">

    	@include('layout.slide')

        <div class="space20"></div>


        <div class="row main-left">
           	@include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>289, đường Nguyễn An Ninh, thị xã Dĩ An, phường Dĩ An, Bình Dương </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>chautuan5498@gmail.com </p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>0332463311 </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.75635605717!2d106.76616925046734!3d10.906112159730386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d8579a641313%3A0x53deb4dfd5fd226d!2zMjg5IE5ndXnhu4VuIEFuIE5pbmgsIETEqSBBbiwgQsOsbmggRMawxqFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1594276707929!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
 @endsection
