@layout('layout.employer')
@section('page-id')page-template@endsection
@section('custom_styles')
{{ HTML::style('/css/jqueryui/jquery-ui.min.css') }}
{{ HTML::style('/css/jqueryui/jquery.ui.slider.min.css') }}
@if(isset($template)) 
<style>
	{{ $template->css }}
</style>
@endif
@endsection
@section('content')

<h2>Custom Templating</h2>
	<div class="row">
		<div class="form-field span7" id="template-container">

			@include('employer.template')	

		</div>
	
	<div id="toolbar" class="span5">
		<div id="custom-template" class="">
			<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
			<div class="viewport">
				<div class="overview">

					@if(isset($template))
					{{ Form::open_for_files("/employer/template/create/$template->id", 'POST', array('id' => 'custom-templating', 'class' => ' validate-form form ')); }}
					@else
					{{ Form::open_for_files("/employer/template/create/", 'POST', array('id' => 'custom-templating', 'class' => ' validate-form form ')); }}
					@endif

					<div id="tab-container" class="tab-container">
						<ul id="controlPaneNav" class="etabs">
							<li class='tab' id="navBasics"><a href="#controlPaneBasics" title="Basic"></a></li>
							<li class='tab' id="navHeader"><a href="#controlPaneHeader" title="Header"></a></li>
							<li class='tab' id="navContent"><a href="#controlPaneContent" title="Content"></a></li>
							<li class='tab' id="navFooter"><a href="#controlPaneFooter" title="Footer"></a></li>
						</ul>
						<div class="panel-container">
							<div id="controlPaneBasics">
								<h1 class="container-header">Template Name</h1>
								<div class="form-content">
									<label for='template-name' id='template-title'>Name</label>
									@if(isset($template)) 
									{{ Form::text("template-name", $template->name, array('class' => 'validate[required]' , 'id' => 'template-name' ,'data-prompt-position' => "topLeft"))}}
									@else
									{{ Form::text("template-name", Input::old('template-name'), array('class' => 'validate[required]', 'id' => 'template-name', 'data-prompt-position' => "topLeft"))}}
									@endif

								</div>
							</div>
							<div id="controlPaneHeader">
								<h4 class="container-header">Header</h4>
								<div class="form-content">
									<ol id="template-header">
										<li>
											<h5>Title Position</h5>
											<div class="btn-toolbar">
												<div class="btn-group" data-toggle="buttons-radio">
													<button type="button" class="btn {{ ( isset($data) && $data['header_text_align'] == 'left' ) ? 'active' : ''  }}" data-value="left" id='btn-align-left'><i class="icon-align-left"></i></button>
													<button type="button" class="btn {{ ( isset($data) && $data['header_text_align'] == 'center' ) ? 'active' : ''  }}" data-value="center" id='btn-align-center'><i class="icon-align-center"></i></button>
													<button type="button" class="btn {{ ( isset($data) && $data['header_text_align'] == 'right' ) ? 'active' : ''  }}" data-value="right" id='btn-align-right'><i class="icon-align-right"></i></button>
												</div>
											</div>
											<input type="hidden" id="head-text-align" name="head-text-align" @if(isset($data['header_text_align']))  value="{{ $data['header_text_align'] }}" @else value="" @endif />
										</li>


										<li>
											<h5>Header Background Image</h5>
											<input type="file" id="header-background" name="header-background" style='display:none' />
											<div class="input-append" id="head-bg">
												<input class="input-large" type="text">
												<a class="btn">Browse</a>
											</div>
											<img style="display:none" width="20" height="20" src="/img/loading.gif" alt="loading" />
										</li>

										<li>
											<h5>Background Repeat</h5>

											<table class="nopad">
												<tr>

													<td>
														<div class="btn-group btn-repeat" data-toggle="buttons-radio">
															<button type="button" class="btn  {{ ( isset($data) && $data['header_repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="header-repeat">All</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['header_repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="header-repeat-x">Horizontal</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['header_repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="header-repeat-y">Vertical</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['header_repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="header-repeat-n">None</button>
														</div>
														<input type="hidden" id="header-repeat-hidden-field" name='header-repeat' value="{{ ( isset($data) ) ? $data['header_repeat'] : '' }}" />
													</td>

													<!--@if(isset($template))
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat", ( $data['header_repeat'] == 'repeat' ) ? true : false  ,  array('id' => 'header-repeat')) }}All</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat-x", ( $data['header_repeat'] == 'repeat-x' ) ? true : false  ,  array('id' => 'header-repeat-x')) }}Horizontal</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat-y", ( $data['header_repeat'] == 'repeat-y' ) ? true : false  ,  array('id' => 'header-repeat-y')) }}Vertical</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "no-repeat",( $data['header_repeat'] == 'no-repeat' ) ? true : false  , array('id' => 'header-repeat-n')) }}No repeat</label></td>
													@else
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat",    false, array('id' => 'header-repeat')) }}All</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat-x",  false, array('id' => 'header-repeat-x')) }}Horizontal</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "repeat-y",  false, array('id' => 'header-repeat-y')) }}Vertical</label></td>
													<td><label class="radio">{{ Form::radio("header-repeat", "no-repeat", false, array('id' => 'header-repeat-n')) }}No repeat</label></td>
													@endif-->
												</tr>
											</table>



										</li>
										<li class="btn-group btn-position" data-toggle="buttons-radio" id="header-bg-position">
											<h5>Background Position</h5>
											<table>
												<tr>
													<td>
														<button title='top left' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'top left' ) ? 'active' : '' }}" data-value="top left" id="header-position-tl"></button>
														<button title='top center' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'top center' ) ? 'active' : '' }}" data-value="top center" id="header-position-tc"></button>
														<button title='top right' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'top right' ) ? 'active' : '' }}" data-value="top right" id="header-position-tr"></button>
													</td>

<!--@if(isset($template))
<td><label class="radio">{{ Form::radio("header-position", "top left",   ( $data['header_position'] == 'top left' ) ? true : false,   array('id' => 'header-position-tl')) }}>Top Left</label></td>
<td><label class="radio">{{ Form::radio("header-position", "top center", ( $data['header_position'] == 'top center' ) ? true : false, array('id' => 'header-position-tc')) }}Top Center</label></td>
<td><label class="radio">{{ Form::radio("header-position", "top right",  ( $data['header_position'] == 'top right' ) ? true : false,  array('id' => 'header-position-tr')) }}Top Right</label></td>
@else
<td><label class="radio">{{ Form::radio("header-position", "top left", false, array('id' => 'header-position-tl')) }}Top Left</label></td>
<td><label class="radio">{{ Form::radio("header-position", "top center", false, array('id' => 'header-position-tc')) }}Top Center</label></td>
<td><label class="radio">{{ Form::radio("header-position", "top right", false, array('id' => 'header-position-tr')) }}Top Right</label></td>
@endif-->
												</tr>
												<tr>
													<td>
														<button title='center left' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'center left' ) ? 'active' : '' }}" data-value="center left" id="header-position-l"></button>
														<button title='center' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'center' ) ? 'active' : '' }}" data-value="center" id="header-position-c"></button>
														<button title='center right' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'center right' ) ? 'active' : '' }}" data-value="center right" id="header-position-r"></button>
													</td>

<!--@if(isset($template))
<td><label class="radio">{{ Form::radio("header-position", "center left", ( $data['header_position'] == 'center left' ) ? true : false,   array('id' => 'header-position-l')) }}Center Left</label></td>
<td><label class="radio">{{ Form::radio("header-position", "center", ( $data['header_position'] == 'center' ) ? true : false,      array('id' => 'header-position-c')) }}Center</label></td>
<td><label class="radio">{{ Form::radio("header-position", "center right", ( $data['header_position'] == 'center right' ) ? true : false, array('id' => 'header-position-r')) }}Center Right</label></td>
@else
<td><label class="radio">{{ Form::radio("header-position", "center left", false, array('id' => 'header-position-l')) }}Center Left</label></td>
<td><label class="radio">{{ Form::radio("header-position", "center", false, array('id' => 'header-position-c')) }}Center</label></td>
<td><label class="radio">{{ Form::radio("header-position", "center right", false, array('id' => 'header-position-r')) }}Center Right</label></td>
@endif-->
												</tr>
												<tr>
													<td>
														<button title='bottom left' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'bottom left' ) ? 'active' : '' }}" data-value="bottom left" id="header-position-bl"></button>
														<button title='bottom center' type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'bottom center' ) ? 'active' : '' }}" data-value="bottom center" id="header-position-bc"></button>
														<button title='bottom right'  type="button" class="btn  {{ ( isset($data) && $data['header_position'] == 'bottom right' ) ? 'active' : '' }}" data-value="bottom right" id="header-position-br"></button>
														<input type="hidden" id="header-position-hidden-field" name='header-position' value="{{ ( isset($data) ) ? $data['header_position'] : '' }}" />
													</td>
													<!--													@if(isset($template))
																										<td><label class="radio">{{ Form::radio("header-position", "bottom left", ( $data['header_position'] == 'bottom left' ) ? true : false,     array('id' => 'header-position-bl')) }}Bottom Left</label></td>
																										<td><label class="radio">{{ Form::radio("header-position", "bottom center", ( $data['header_position'] == 'bottom center' ) ? true : false, array('id' => 'header-position-bc')) }}Bottom Center</label></td>
																										<td><label class="radio">{{ Form::radio("header-position", "bottom right", ( $data['header_position'] == 'bottom right' ) ? true : false,   array('id' => 'header-position-br')) }}Bottom Right</label></td>
																										@else
																										<td><label class="radio">{{ Form::radio("header-position", "bottom left", false, array('id' => 'header-position-bl')) }}Bottom Left</label></td>
																										<td><label class="radio">{{ Form::radio("header-position", "bottom center", false, array('id' => 'header-position-bc')) }}Bottom Center</label></td>
																										<td><label class="radio">{{ Form::radio("header-position", "bottom right", false, array('id' => 'header-position-br')) }}Bottom Right</label></td>
																										@endif-->
												</tr>

											</table>

										</li>
									</ol>
								</div>
								<!-- /.form-content -->
							</div>
							<div id="controlPaneContent">
								<h4 class="container-header">Body</h4>
								<div class="form-content">
									<ol id="template-body">				
										<li>
											<h5>Body Background Image</h5>
											<input type="file" id="body-background" name="body-background" style='display:none'/><img style="display:none" width="20" height="20" src="/img/loading.gif" alt="loading" />
											<div class="input-append" id="body-bg">
												<input class="input-large" type="text">
												<a class="btn">Browse</a>
											</div>
										</li>
										<li>
											<h5>Background Repeat</h5>
											<table class="nopad">
												<tr>
													<td>
														<div class="btn-group btn-repeat" data-toggle="buttons-radio">
															<button type="button" class="btn  {{ ( isset($data) && $data['body_repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="body-repeat">All</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['body_repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="body-repeat-x">Horizontal</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['body_repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="body-repeat-y">Vertical</button>
															<button type="button" class="btn  {{ ( isset($data) && $data['body_repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="body-repeat-n">None</button>
														</div>
														<input type="hidden" id="body-repeat-hidden-field" name='body-repeat'  value="{{ ( isset($data) ) ? $data['body_repeat'] : '' }}"/>
													</td>
<!--													<td>
														@if(isset($template))
														<label class="radio">{{ Form::radio("body-repeat", "repeat-x", ( $data['body_repeat'] == 'repeat-x' ) ? true : false, array('id' => 'body-repeat-x')) }}Horizontal</label>
														@else
														<label class="radio">{{ Form::radio("body-repeat", "repeat-x", false, array('id' => 'body-repeat-x')) }}Horizontal</label>
														@endif
													</td>
													<td>
														@if(isset($template))
														<label class="radio">{{ Form::radio("body-repeat", "repeat-y", ( $data['body_repeat'] == 'repeat-y' ) ? true : false, array('id' => 'body-repeat-y')) }}Vertical</label>	
														@else
														<label class="radio">{{ Form::radio("body-repeat", "repeat-y", false, array('id' => 'body-repeat-y')) }}Vertical</label>	
														@endif
													</td>
													<td>
														@if(isset($template))
														<label class="radio">{{ Form::radio("body-repeat", "no-repeat", ( $data['body_repeat'] == 'no-repeat' ) ? true : false, array('id' => 'body-repeat-n')) }}No repeat</label>
														@else
														<label class="radio">{{ Form::radio("body-repeat", "no-repeat",false, array('id' => 'body-repeat-n')) }}No repeat</label>
														@endif
													</td>-->
												</tr>
											</table>

										</li>

										<li class="btn-group btn-position" data-toggle="buttons-radio" id="body-bg-position">
											<h5>Background Position</h5>
											<table>
												<tr>
													<td>
														<button title='top left' type="button" class="btn  {{ (isset($data) &&  $data['body_position'] == 'top left' ) ? 'active' : '' }}" data-value="top left" id="body-position-tl"></button>
														<button title='top center' type="button" class="btn  {{ (isset($data) &&  $data['body_position'] == 'top center' ) ? 'active' : '' }}" data-value="top center" id="body-position-tc"></button>
														<button title='top right' type="button" class="btn  {{ (isset($data) &&  $data['body_position'] == 'top right' ) ? 'active' : '' }}" data-value="top right" id="body-position-tr"></button>
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("body-position", "top left",   ( $data['body_position'] == 'top left' ) ? true : false,     array('id' => 'body-position-tl')) }}Top Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "top center", ( $data['body_position'] == 'top center' ) ? true : false, array('id' => 'body-position-tc')) }}Top Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "top right",  ( $data['body_position'] == 'top right' ) ? true : false,   array('id' => 'body-position-tr')) }}Top Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("body-position", "top left", false, array('id' => 'body-position-tl')) }}Top Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "top center", false, array('id' => 'body-position-tc')) }}Top Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "top right", false, array('id' => 'body-position-tr')) }}Top Right</label></td>
													@endif-->
												</tr>
												<tr>
													<td>
														<button title='center left' type="button" class="btn  {{ ( isset($data) && $data['body_position'] == 'center left' ) ? 'active' : '' }}" data-value="center left" id="body-position-l"></button>
														<button title='center' type="button" class="btn  {{ ( isset($data) && $data['body_position'] == 'center' ) ? 'active' : '' }}" data-value="center" id="body-position-c"></button>
														<button title='cetner right' type="button" class="btn  {{ ( isset($data) && $data['body_position'] == 'center right' ) ? 'active' : '' }}" data-value="center right" id="body-position-r"></button>
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("body-position", "center left",  ( $data['body_position'] == 'center left' ) ? true : false,    array('id' => 'body-position-l')) }}Center Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "center",       ( $data['body_position'] == 'center' ) ? true : false,              array('id' => 'body-position-c')) }}Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "center right", ( $data['body_position'] == 'center right' ) ? true : false,  array('id' => 'body-position-r')) }Center Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("body-position", "center left", false, array('id' => 'body-position-l')) }}Center Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "center", false, array('id' => 'body-position-c')) }}Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "center right", false, array('id' => 'body-position-r')) }}Center Right</label></td>
													@endif-->
												</tr>
												<tr>
													<td>
														<button title='bottom left' type="button" class="btn  {{ ( isset($data) && $data['body_position'] == 'bottom left' ) ? 'active' : '' }}" data-value="bottom left" id="body-position-bl"></button>
														<button title='bottom center' type="button" class="btn  {{ ( isset($data) && $data['body_position'] == 'bottom center' ) ? 'active' : '' }}" data-value="bottom center" id="body-position-bc"></button>
														<button title='bottom right' type="button" class="btn  {{ ( isset($data) &&  $data['body_position'] == 'bottom right' ) ? 'active' : '' }}" data-value="bottom right" id="body-position-br"></button>
														<input type="hidden" id="body-position-hidden-field" name='body-position' value="{{ ( isset($data) ) ? $data['body_position'] : '' }}" />
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("body-position", "bottom left",   ( $data['body_position'] == 'bottom left' ) ? true : false,   array('id' => 'body-position-bl')) }}Bottom Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "bottom center", ( $data['body_position'] == 'bottom center' ) ? true : false, array('id' => 'body-position-bc')) }}Bottom Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "bottom right",  ( $data['body_position'] == 'bottom right' ) ? true : false,  array('id' => 'body-position-br')) }}Bottom Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("body-position", "bottom left", false, array('id' => 'body-position-bl')) }}Bottom Left</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "bottom center", false, array('id' => 'body-position-bc')) }}Bottom Center</label></td>
													<td><label class="radio">{{ Form::radio("body-position", "bottom right", false, array('id' => 'body-position-br')) }}Bottom Right</label></td>
													@endif-->
												</tr>

											</table>

										</li>
									</ol>
								</div>
								<!-- /.form-content -->
							</div>
							<div id="controlPaneFooter">
								<h4 class="container-header">Footer</h4>
								<div class="form-content">
									<ol id="template-footer">
										<li>
											<h5>Footer Background Image</h5>
											<input type="file" id="footer-background" name="footer-background" style='display:none' /><img style="display:none" width="20" height="20" src="/img/loading.gif" alt="loading" />
											<div class="input-append" id="footer-bg">
												<input class="input-large" type="text">
												<a class="btn">Browse</a>
											</div>
										</li>
										<li>
											<h5>Background Repeat</h5>
											<table>
												<tr>
													<td>
														<div class="btn-group btn-repeat" data-toggle="buttons-radio">
															<button type="button" class="btn  {{ ( isset($data) &&  $data['footer_repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="footer-repeat">All</button>
															<button type="button" class="btn  {{ ( isset($data) &&  $data['footer_repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="footer-repeat-x">Horizontal</button>
															<button type="button" class="btn  {{ ( isset($data) &&  $data['footer_repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="footer-repeat-y">Vertical</button>
															<button type="button" class="btn  {{ ( isset($data) &&  $data['footer_repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="footer-repeat-n">None</button>
														</div>
														<input type="hidden" id="footer-repeat-hidden-field" name='footer-repeat'  value="{{ ( isset($data) ) ? $data['footer_repeat'] : '' }}"/>
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("footer-repeat", "repeat-x",  ( $data['footer_repeat'] == 'repeat-y' ) ? true : false,  array('id' => 'footer-repeat-x')) }}Horizontal</label></td>
													<td><label class="radio">{{ Form::radio("footer-repeat", "repeat-y",  ( $data['footer_repeat'] == 'repeat-x' ) ? true : false,  array('id' => 'footer-repeat-y')) }}Vertical</label></td>
													<td><label class="radio">{{ Form::radio("footer-repeat", "no-repeat", ( $data['footer_repeat'] == 'no-repeat' ) ? true : false, array('id' => 'footer-repeat-n')) }}No repeat</label></td>
													@else
													<td><label class="radio">{{ Form::radio("footer-repeat", "repeat-x", false, array('id' => 'footer-repeat-x')) }}Horizontal</label></td>
													<td><label class="radio">{{ Form::radio("footer-repeat", "repeat-y", false, array('id' => 'footer-repeat-y')) }}Vertical</label></td>
													<td><label class="radio">{{ Form::radio("footer-repeat", "no-repeat", false, array('id' => 'footer-repeat-n')) }}No repeat</label></td>
													@endif-->
												</tr>
											</table>

										</li>

										<li class="btn-group btn-position" data-toggle="buttons-radio" id="footer-bg-position">
											<h5>Background Position</h5> <a href='#'>Help</a>
											<table>
												<tr>
													<td>
														<button title='top left' type="button" class="btn {{ ( isset($data) &&  $data['footer_position'] == 'top left' ) ? 'active' : '' }}" data-value="top left" id="footer-position-tl"></button>
														<button title='top center' type="button" class="btn {{ ( isset($data) &&  $data['footer_position'] == 'top center' ) ? 'active' : '' }}" data-value="top center" id="footer-position-tc"></button>
														<button title='top right' type="button" class="btn {{ ( isset($data) &&  $data['footer_position'] == 'top right' ) ? 'active' : '' }}" data-value="top right" id="footer-position-tr"></button>
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("footer-position", "top left",    ( $data['footer_position'] == 'top left' ) ? true : false,   array('id' => 'footer-position-tl')) }}Top Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "top center",  ( $data['footer_position'] == 'top center' ) ? true : false, array('id' => 'footer-position-tc')) }}Top Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "top right",   ( $data['footer_position'] == 'top right' ) ? true : false,  array('id' => 'footer-position-tr')) }}Top Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("footer-position", "top left", false, array('id' => 'footer-position-tl')) }}Top Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "top center", false, array('id' => 'footer-position-tc')) }}Top Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "top right", false, array('id' => 'footer-position-tr')) }}Top Right</label></td>
													@endif-->
												</tr>
												<tr>
													<td>
														<button title='center left' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'center left' ) ? 'active' : '' }}" data-value="center left" id="footer-position-l"></button>
														<button title='center' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'center' ) ? 'active' : '' }}" data-value="center" id="footer-position-c"></button>
														<button title='center right' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'center right' ) ? 'active' : '' }}" data-value="center right" id="footer-position-r"></button>
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("footer-position", "center left",   ( $data['footer_position'] == 'center left' ) ? true : false,  array('id' => 'footer-position-l')) }}Center Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "center", ( $data['footer_position'] == 'center' ) ? true : false,       array('id' => 'footer-position-c')) }}Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "center right",  ( $data['footer_position'] == 'center right' ) ? true : false, array('id' => 'footer-position-r')) }}Center Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("footer-position", "center left", false, array('id' => 'footer-position-l')) }}Center Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "center", false, array('id' => 'footer-position-c')) }}Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "center right", false, array('id' => 'footer-position-r')) }}Center Right</label></td>
													@endif-->
												</tr>
												<tr>
													<td>
														<button title='bottom left' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'bottom left' ) ? 'active' : '' }}" data-value="bottom left" id="footer-position-bl"></button>
														<button title='bottom center' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'bottom center' ) ? 'active' : '' }}" data-value="bottom center" id="footer-position-bc"></button>
														<button title='bottom right' type="button" class="btn {{ ( isset($data) && $data['footer_position'] == 'bottom right' ) ? 'active' : '' }}" data-value="bottom right" id="footer-position-br"></button>
														<input type="hidden" id="footer-position-hidden-field" name='footer-position' value="{{ ( isset($data) ) ? $data['footer_position'] : '' }}"  />
													</td>
<!--													@if(isset($template))
													<td><label class="radio">{{ Form::radio("footer-position", "bottom left",   ( $data['footer_position'] == 'bottom left' ) ? true : false,     array('id' => 'footer-position-bl')) }}Bottom Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "bottom center", ( $data['footer_position'] == 'bottom center' ) ? true : false,   array('id' => 'footer-position-bc')) }}Bottom Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "bottom right",  ( $data['footer_position'] == 'bottom right' ) ? true : false,    array('id' => 'footer-position-br')) }}Bottom Right</label></td>
													@else
													<td><label class="radio">{{ Form::radio("footer-position", "bottom left", false, array('id' => 'footer-position-bl')) }}Bottom Left</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "bottom center", false, array('id' => 'footer-position-bc')) }}Bottom Center</label></td>
													<td><label class="radio">{{ Form::radio("footer-position", "bottom right", false, array('id' => 'footer-position-br')) }}Bottom Right</label></td>
													@endif-->
												</tr>

											</table>

										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>


					<!-- /.form-content -->
					<input class="btn-primary btn-large" id="submit-template" type="submit" value="Save Template" />
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<!-- /#custom-template -->
	</div>
</div>
@endsection

