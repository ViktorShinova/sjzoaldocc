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

<h2>Create your own template!</h2>
<br/>
<div class="row">
	<div class="form-field span8" id="template-container">

		@include('employer.template')	

	</div>

	<div id="toolbar" class="span4">
		<div id="custom-template">

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
						<h4>Template Name</h4>
						<div class="pad">
							<label for='template-name' id='template-title'>Name</label>
							@if(isset($template)) 
							{{ Form::text("template-name", $template->name, array('class' => 'validate[required]' , 'id' => 'template-name' ,'data-prompt-position' => "topLeft"))}}
							@else
							{{ Form::text("template-name", Input::old('template-name'), array('class' => 'validate[required]', 'id' => 'template-name', 'data-prompt-position' => "topLeft"))}}
							@endif

						</div>
					</div>
					<div id="controlPaneHeader">
						<h4>Header Section</h4>
						<div class="pad">
							<ol id="template-header">
								<li>
									<label>Type:</label>
									<div class="btn-toolbar">
										<div class="btn-group" data-toggle="buttons-radio">
											<button type="button" class="btn {{ (isset($template) && $data['title-type'] == 'title' )? 'active' : ''}}" id="text-title" >Text title</button>
											<button type="button" class="btn {{ (isset($template) && $data['title-type'] == 'image' )? 'active' : ''}}" id="title-image-header">Image header</button>										
										</div>
									</div>
									@if( isset($template)) 
									<input type='hidden' name='title-type' value='title' value="{{$data['title-type']}}"/>
									@else
									<input type='hidden' name='title-type' value='title' />
									@endif
									
								</li>

								<li class="image-title">

									<label>Image<a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="Please upload image with a size of 768px (width) 120px (height). Images that are bigger than this will be scaled to the given size."><i class="icon-question-sign"></i></a></label>
									<div class="pull-left color-wrapper">
										<input type="file" id="header-image" name="header-image" style='display:none' />
										<div class="input-append" id="head-image">
											<input class="input-small" type="text" readonly="readonly" id="header-image-file">
											<a class="btn">Browse</a>
										</div>
									</div>
									<img width="20" height="20" src="/img/loading.gif" alt="loading" class='loading' />
									<span class="help-block">Please upload image with a size of 768px (width) 120px (height). Images that are bigger than this will be scaled to the given size.</span>

								</li>

								<li class="title">
									<label>Title Color:</label>
									@if( isset($template))
									<input type="text" id="title-color" name="title-color" class="color-picker" readonly="readonly"  value="{{ $data['title-color'] }}" title='Please choose a colour' style='background-color: {{ $data['title-color'] }}'/>
									@else
									<input type="text" id="title-color" name="title-color" class="color-picker" readonly="readonly" title='Please choose a colour'/>
									@endif
									<div id="title-colorpicker"></div>
								</li>

								<li class="title">
									<label>Alignment:</label>
									<div class="btn-toolbar">
										<div class="btn-group" data-toggle="buttons-radio">
											<button type="button" class="btn {{ ( isset($data) && $data['head-text-align'] == 'left' ) ? 'active' : ''  }}" data-value="left" id='btn-align-left'><i class="icon-align-left"></i></button>
											<button type="button" class="btn {{ ( isset($data) && $data['head-text-align'] == 'center' ) ? 'active' : ''  }}" data-value="center" id='btn-align-center'><i class="icon-align-center"></i></button>
											<button type="button" class="btn {{ ( isset($data) && $data['head-text-align'] == 'right' ) ? 'active' : ''  }}" data-value="right" id='btn-align-right'><i class="icon-align-right"></i></button>
										</div>
									</div>
									<input type="hidden" id="head-text-align" name="head-text-align" @if(isset($data['head-text-align']))  value="{{ $data['head-text-align'] }}" @else value="" @endif />
								</li>

								<li class="title">
									<label>Background:</label>

									<div class="pull-left color-wrapper">
										@if( isset($template))
										<input type="text" id="hbg-color" name="hbg-color" class="color-picker" readonly="readonly" value="{{ $data['hbg-color'] }}"  title='Please choose a colour' style='background-color: {{ $data['hbg-color'] }}'/>
										@else
										<input type="text" id="hbg-color" name="hbg-color" class="color-picker" readonly="readonly"  title='Please choose a colour'/>	
										@endif
										<div id="hbg-colorpicker"></div>
									</div>
									<div class="pull-left">
										<input type="file" id="header-background" name="header-background" style='display:none' value=""/>
										<div class="input-append" id="head-bg">
											<input class="input-small" type="text" id="header-background-file" readonly="readonly" >
											<a class="btn">Browse</a>
										</div>
										
									</div>
									<img width="20" height="20" src="/img/loading.gif" alt="loading" class='loading' />
								</li>

								<li class="title">
									<label class="long">Direction of background (only for uploaded images): <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="Please hover over the buttons for more information."><i class="icon-question-sign"></i></a></label>
									<table class="nopad">
										<tr>

											<td>

												<div class="btn-group btn-repeat" data-toggle="buttons-radio">
													<button title="Choosing this option will repeat the background image in both vertical and horizontal direction. This will be the default selection." type="button" class="btn  {{ ( isset($data) && $data['header-repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="header-repeat">All </button>
													<button title="Choosing this option will repeat the background image in the horizontal direction." type="button" class="btn  {{ ( isset($data) && $data['header-repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="header-repeat-x">Horizontal</button>
													<button title="Choosing this option will repeat the background image in the vertical direction." type="button" class="btn  {{ ( isset($data) && $data['header-repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="header-repeat-y">Vertical</button>
													<button title="Choosing this option will not repeat the background image." type="button" class="btn  {{ ( isset($data) && $data['header-repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="header-repeat-n">None</button>
												</div>
												<input type="hidden" id="header-repeat-hidden-field" name='header-repeat' value="{{ ( isset($data) ) ? $data['header-repeat'] : '' }}" />
											</td>
										</tr>
									</table>



								</li>
								<li id="header-bg-position" class='title'>
									<label class="long">Background Position: <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="The position of the background in the area. Click on the buttons to change them. This option will only work if you have selected 'Horizontal' or 'Vertical' for the direction of the background image.  "><i class="icon-question-sign"></i></a></label>
									@if(isset($template)) 
									{{Form::select('header-position', $position_options, $data['header-position'], array('id' => 'header-position') ) }}
									@else
									{{Form::select('header-position', $position_options, Input::old('header-position'), array('id' => 'header-position') ) }}
									@endif
									
								</li>
							</ol>
							<div class='clearfix'></div>
						</div>
						<!-- /.form-content -->
					</div>
					<div id="controlPaneContent">
						<h4>Body Section</h4>
						<div class="pad">
							<ol id="template-body">	
								<li>
									<label>Text Color:</label>
									@if( isset($template)) 
									<input type="text" id="body-color" name="body-color" class="color-picker" readonly="readonly" value="{{ $data['body-color'] }}"  title='Please choose a colour' style='background-color: {{ $data['body-color'] }}'/>						
									@else
									<input type="text" id="body-color" name="body-color" class="color-picker" readonly="readonly"  title='Please choose a colour' />
									@endif
									<div id="body-colorpicker"></div>
								</li>
								<li>
									<label>Background</label>
									<div class="pull-left color-wrapper">
										@if( isset($template)) 
										<input type="text" id="bbg-color" name="bbg-color" class="color-picker" readonly="readonly" value="{{ $data['bbg-color'] }}"  title='Please choose a colour' style='background-color: {{ $data['bbg-color'] }}'/>
										@else
										<input type="text" id="bbg-color" name="bbg-color" class="color-picker" readonly="readonly"  title='Please choose a colour' />
										@endif
										<div id="bbg-colorpicker"></div>
									</div>
									<div class="pull-left">
										<input type="file" id="body-background" name="body-background" style='display:none'/>
										<div class="input-append" id="body-bg">
											<input class="input-small" type="text" readonly="readonly" id="body-background-file">
											<a class="btn">Browse</a>
										</div>
									</div>
									<img width="20" height="20" src="/img/loading.gif" alt="loading" class='loading' />
								</li> 
									<label class="long">Direction of background (only for uploaded images): <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="Please hover over the buttons for more information."><i class="icon-question-sign"></i></a></label>

									<table class="nopad">
										<tr>
											<td>
												<div class="btn-group btn-repeat" data-toggle="buttons-radio">
													<button title="Choosing this option will repeat the background image in both vertical and horizontal direction. This will be the default selection." type="button" class="btn  {{ ( isset($data) && $data['body-repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="body-repeat">All</button>
													<button title="Choosing this option will repeat the background image in the horizontal direction." type="button" class="btn  {{ ( isset($data) && $data['body-repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="body-repeat-x">Horizontal</button>
													<button title="Choosing this option will repeat the background image in the vertical direction." type="button" class="btn  {{ ( isset($data) && $data['body-repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="body-repeat-y">Vertical</button>
													<button title="Choosing this option will not repeat the background image." type="button" class="btn  {{ ( isset($data) && $data['body-repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="body-repeat-n">None</button>
												</div>
												<input type="hidden" id="body-repeat-hidden-field" name='body-repeat'  value="{{ ( isset($data) ) ? $data['body-repeat'] : '' }}"/>
											</td>										
										</tr>
									</table>

								</li>

								<li id="body-bg-position">
									<label class="long">Background Position: <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="The position of the background in the area. Click on the buttons to change them. This option will only work if you have selected 'Horizontal' or 'Vertical' for the direction of the background image.  "><i class="icon-question-sign"></i></a></label>
									@if(isset($template))
									{{Form::select('body-position', $position_options, $data['body-position'], array('id' => 'body-position') ) }}
									@else
									{{Form::select('body-position', $position_options, Input::old('body-position'), array('id' => 'body-position') ) }}
									@endif
								</li>
							</ol>
						</div>
						<!-- /.form-content -->
					</div>
					<div id="controlPaneFooter">
						<h4>Footer Section</h4>
						<div class="pad">
							<ol id="template-footer">
								<li>
									<label>Text Color:</label>
									@if(isset($template))
									<input type="text" id="footer-color" name="footer-color" class="color-picker" readonly="readonly" value="{{ $data['footer-color'] }}" title='Please choose a colour' style='background-color: {{ $data['footer-color'] }}'/>
									@else
									<input type="text" id="footer-color" name="footer-color" class="color-picker" readonly="readonly" title='Please choose a colour'/>
						
									@endif
										   
									<div id="footer-colorpicker"></div>
								</li>
								<li>
									<label>Background</label>


									<div  class="pull-left color-wrapper">
										@if(isset($template))
										<input type="text" id="fbg-color" name="fbg-color" class="color-picker" readonly="readonly" value="{{ $data['fbg-color'] }}"  title='Please choose a colour' style='background-color: {{ $data['fbg-color'] }}'/>
										@else
										<input type="text" id="fbg-color" name="fbg-color" class="color-picker" readonly="readonly"  title='Please choose a colour' />
										@endif
										<div id="fbg-colorpicker"></div>
									</div>
									<div id="fbg-image-wrapper" class="pull-left">
										<input type="file" id="footer-background" name="footer-background" style='display:none' />
										<div class="input-append" id="footer-bg">
											<input class="input-small" type="text" readonly="readonly" id="footer-background-file">
											<a class="btn">Browse</a>
										</div>
									</div>
									<img width="20" height="20" src="/img/loading.gif" alt="loading" class='loading'/>

								</li>
								<li>
									<label class="long">Direction of background (only for uploaded images): <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="Please hover over the buttons for more information."><i class="icon-question-sign"></i></a></label>
									
									<table>
										<tr>
											<td>
												<div class="btn-group btn-repeat" data-toggle="buttons-radio">
													<button title="Choosing this option will repeat the background image in both vertical and horizontal direction. This will be the default selection." type="button" class="btn  {{ ( isset($data) &&  $data['footer-repeat'] == 'repeat' ) ? 'active' : '' }}" data-value="repeat" id="footer-repeat">All</button>
													<button title="Choosing this option will repeat the background image in the horizontal direction." type="button" class="btn  {{ ( isset($data) &&  $data['footer-repeat'] == 'repeat-x' ) ? 'active' : '' }}" data-value="repeat-x" id="footer-repeat-x">Horizontal</button>
													<button title="Choosing this option will repeat the background image in the vertical direction."  type="button" class="btn  {{ ( isset($data) &&  $data['footer-repeat'] == 'repeat-y' ) ? 'active' : '' }}" data-value="repeat-y" id="footer-repeat-y">Vertical</button>
													<button title="Choosing this option will not repeat the background image." type="button" class="btn  {{ ( isset($data) &&  $data['footer-repeat'] == 'no-repeat' ) ? 'active' : '' }}" data-value="no-repeat" id="footer-repeat-n">None</button>
												</div>
												<input type="hidden" id="footer-repeat-hidden-field" name='footer-repeat'  value="{{ ( isset($data) ) ? $data['footer-repeat'] : '' }}"/>
											</td>
										</tr>
									</table>

								</li>

								<li  id="footer-bg-position">
									<label class="long">Background Position: <a class='tooltip-a' href="#" rel="tooltip" data-toggle="tooltip" title="The position of the background in the area. Click on the buttons to change them. This option will only work if you have selected 'Horizontal' or 'Vertical' for the direction of the background image.  "><i class="icon-question-sign"></i></a></label>
									@if(isset($template))
									{{Form::select('footer-position', $position_options, $data['footer-position'], array('id' => 'footer-position')) }}
									@else
									{{Form::select('footer-position', $position_options, Input::old('footer-position'), array('id' => 'footer-position')) }}									
									@endif
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>


			<!-- /.form-content -->
			<input class="btn-primary btn-large" id="submit-template" type="submit" value="Save Template" />
			<a href="/employer/template/list" class="btn btn-danger btn-large">Cancel Edit</a>
			{{ Form::close() }}


		</div>
		<!-- /#custom-template -->
	</div>
</div>
@endsection

