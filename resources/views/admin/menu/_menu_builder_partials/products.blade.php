<li class="control-section accordion-section add-post" id="add-post">
	<h3 class="accordion-section-title hndle" tabindex="0"> 
		Product Link <span class="screen-reader-text">Press return or enter to expand</span>
	</h3>
	<div class="accordion-section-content ">
		<div class="inside">
			<div class="customlinkdiv" id="customlinkdiv">
 
	<label class="howto" for="custom-menu-item-name"> 
		<select class="custom-select custom-select">
			<option value="0">Select Product</option>
			@foreach($menuProducts as $product)
				<option value="{{ $product->id }}" label="{{ $product->name }}" url="products/{{ $product->slug }}">{{ ucfirst($product->name) }}</option>
			@endforeach
		</select>
		<input name="url" id="custom-menu-item-url-product" type="hidden">
		<input name="label" id="custom-menu-item-name-product" type="hidden">
	</label>
					&nbsp;
					<p class="button-controls">
						<a  href="#" onclick="addcustommenu('product')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
						<span class="spinner" id="spincustomu"></span>
					</p>
			</div>
		</div>
	</div>
</li>