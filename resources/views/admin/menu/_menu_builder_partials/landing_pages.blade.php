<li class="control-section accordion-section add-post" id="add-post">
	<h3 class="accordion-section-title hndle" tabindex="0"> 
		Landing Pages Link <span class="screen-reader-text">Press return or enter to expand</span>
	</h3>
	<div class="accordion-section-content ">
		<div class="inside">
			<div class="customlinkdiv" id="customlinkdiv">
	<label class="howto" for="custom-menu-item-name"> 
		<select class="custom-select custom-select">
			<option value="0">Select Landing Page</option>
			@foreach($menuLandingPages as $landingPage)
				<option value="{{ $landingPage->id }}" label="{{ $landingPage->title }}" url="{{ $landingPage->slug }}">{{ ucfirst($landingPage->title) }}</option>
			@endforeach
		</select>
		<input name="url" id="custom-menu-item-url-landingPage" type="hidden">
		<input name="label" id="custom-menu-item-name-landingPage" type="hidden">
	</label>
					&nbsp;
					<p class="button-controls">
						<a href="#"  onclick="addcustommenu('landingPage')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
						<span class="spinner" id="spincustomu"></span>
					</p>
			</div>
		</div>
	</div>
</li>