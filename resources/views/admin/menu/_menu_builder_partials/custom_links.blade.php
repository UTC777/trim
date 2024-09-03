<li class="control-section accordion-section  open add-page" id="add-page">
<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
<div class="accordion-section-content ">
	<div class="inside">
		<div class="customlinkdiv" id="customlinkdiv">
			<p id="menu-item-url-wrap">
				<label class="howto" for="custom-menu-item-url-custom"> <span>URL</span>&nbsp;&nbsp;&nbsp;
					<input id="custom-menu-item-url-custom" name="url" type="text" class="menu-item-textbox " placeholder="url">
				</label>
			</p>

			<p id="menu-item-name-wrap">
				<label class="howto" for="custom-menu-item-name-custom"> <span>Label</span>&nbsp;
					<input id="custom-menu-item-name-custom" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
				</label>
			</p>

			{{-- @if(!empty($roles))
			<p id="menu-item-role_id-wrap">
				<label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
					<select id="custom-menu-item-role-custom" name="role">
						<option value="0">Select Role</option>
						@foreach($roles as $role)
							<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
						@endforeach
					</select>
				</label>
			</p>
			@endif --}}
			<p><i class="text-danger"><small style="font-size:70%!important;">IF YOU ARE MAKING A INTERNAL CUSTOM LINK. DO NOT USE A "/" AT THE START.</small></i></p>

			<p class="button-controls">

				<a  href="#" onclick="addcustommenu('custom')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
				<span class="spinner" id="spincustomu"></span>
			</p>

		</div>
	</div>
</div>
</li>