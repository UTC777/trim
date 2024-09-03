<div class="flex-column p-2">
	<input class="col-12" type="hidden" id="meta-url" value="{{ url('') }}/{{ $staticSeo->page_path ?? '' }}" placeholder="Meta Webiste URL">
		
	<div class="row">
		<div class="col-5 card m-4 p-4">
			<h5>Google Preview</h5>
			<div id="seopreview-google" class="col-12"></div>
		</div>
		<div class="col-5 card m-4 p-4">
			<h5>Facebook Preview</h5>
			<div id="seopreview-facebook" class="col-12"></div>
		</div>	
		
	</div>
</div>