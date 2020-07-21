@extends('user.master.header')

@section('title')
Liên hệ
@endsection

@section('noidung')
<section>
		<div class="container" style="padding-top: 20px;">
			<div class="row" style="margin: 0px;">
				<div class="col-md-4">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin liên hệ</p>
						<table class="table">
							<tbody>
								@foreach($lienhe as $list)
								<tr>
									<td><p><strong>{{$list->lienhe}}:</strong><span>&nbsp{{$list->thongtin}}</span></p></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel">
						@if(isset($maps))
							{!!$maps->maps!!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('style')
<style type="text/css">
	.text-primary {
    	color: #ef5222 !important;
	}
	.text-uppercase {
	    text-transform: uppercase !important;
	}
	.text-center {
	    text-align: center !important;
	}
	p {
	    margin: 0 0 10px;
	}
	.panel{
	    border: 1px solid #ddd;
	    padding: 10px;
	    margin-bottom: 20px;
	}

	.seat{
		height: 28px;
		width: 35px;
		color: #999;
		cursor: pointer;
		border: 1px solid #424242;
		border-radius: 3px;
		background: #2b2b2b;
		padding: 5px 10px;
		margin: 2px 4px 2px 2px;
		display: inline-block;
		font-weight: 700;
		font-size: 11px;
		text-align: center;
	}
	.non-choose{
		background: #F42536;
		color: #fff;
	}
	.choose{
		background: #007bff;
		color: #fff;
	}

	.text-seat{
		padding-top: 30px;
		padding-left: 15px;
		font-weight: bold;
	}

	.non-choose:hover{
		cursor: pointer;
		box-shadow: 0 0 0px 2px #5C6AFF;
	}

	.form-datve{
		margin-top: 30px;
	}

	.button-submit{
		width: 200px;
		padding: 12px 0;
		border: none;
		border-radius: 50px;
		background-color: #ff3c5a;		
		font-size: 15px;
		font-weight: 700;
		color: #fff;
		margin-bottom: 20px;
		cursor: pointer;
	}

	.button-submit:hover{
		background: #ff3c87;
	}

	iframe {
		width: 100%;
	}

</style>
@endsection
