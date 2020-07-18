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
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
					   <p>
					   	<strong>
					   		<center>WEBSITE TIN TỨC - FRAMEWORK LARAVEL.
					   	</strong>		   
					   		<p> Tin tức là những việc đã xảy ra dù tốt dù xấu, để giúp con người biết những chuyện xung quanh và trên Thế giới. Ngày nau nhờ thông tin truyền thông nhanh, cho nên bất cứ chuyện gì vừa xảy ra ở đâu trên thế giới thì ta đều có thể biết ngay, nhờ đó mà có thể học được nhiều cái hay cũng như tránh được những chuyện xấu xảy ra,như các trận sóng Thần, bão tap, núi lửa sắp đến,các chất độc hại trong thức ăn,... giúp con người biết trước mà tránh khỏi các nguy hiểm sắp đến.</p>

					   		<p> Tin Tức vô cùng quan trọng nó cho người ta trí thức và là cơ sở để người ta tiến hành mọi việc lớn nhỏ. Khi có Internet, tin tức càng quan trọng vì tốc độ lan truyền nhanh ảnh hưởng ngay tức thì trên diện rộng.</p>				   	
					   </p>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
 @endsection