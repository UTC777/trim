<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "Move up",
		"moveDown" : "Mover down",
		"moveToTop" : "Move top",
		"moveUnder" : "Move under of %s",
		"moveOutFrom" : "Out from under  %s",
		"under" : "Under %s",
		"outFrom" : "Out from %s",
		"menuFocus" : "%1$s. Element menu %2$d of %3$d.",
		"subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
	};
	var arraydata = [];     
	var add_env_conditionals= '{{ route("admin.add_env_conditionals") }}';
	var logged_in_only= '{{ route("admin.logged_in_only") }}';
	var icon_only_menu= '{{ route("admin.icon_only_menu") }}';
	var add_menu_icon_class= '{{ route("admin.add_menu_icon_class") }}';
	var MenuUsers= '{{ route("admin.MenuUsers") }}';
	var MenuRoles= '{{ route("admin.MenuRoles") }}';
	var addcustommenur= '{{ route("haddcustommenu") }}';
	var updateitemr= '{{ route("hupdateitem")}}';
	var generatemenucontrolr= '{{ route("hgeneratemenucontrol") }}';
	var deleteitemmenur= '{{ route("hdeleteitemmenu") }}';
	var deletemenugr= '{{ route("hdeletemenug") }}';
	var createnewmenur= '{{ route("hcreatenewmenu") }}';
	var csrftoken="{{ csrf_token() }}";
	var menuwr = "{{ url()->current() }}";
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('vendor/wecodelaravel-menu/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/wecodelaravel-menu/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/wecodelaravel-menu/menu.js')}}"></script>