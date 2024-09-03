<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.dashboard") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
{{--        @include('partials.menu.products')--}}
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/sliders*") ? "c-show" : "" }}  {{ request()->is("admin/content-pages*") ? "c-show" : "" }} {{ request()->is("admin/posts*") ? "c-show" : "" }} {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/pagesections*") ? "c-show" : "" }} {{ request()->is("admin/content-sections*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('slider_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-images c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.slider.title') }}
                            </a>
                        </li>
                    @endcan

                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pagesection_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pagesections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pagesections") || request()->is("admin/pagesections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pagesection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_section_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-sections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-sections") || request()->is("admin/content-sections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentSection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('post_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.posts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/posts") || request()->is("admin/posts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.post.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                        @can('comment_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.comments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comments") || request()->is("admin/comments/*") ? "c-active" : "" }}">
                                    <i class="fa-fw far fa-comments c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.comment.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('seenon_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.seenons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seenons") || request()->is("admin/seenons/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-external-link-alt c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.seenon.title') }}
                                </a>
                            </li>
                        @endcan

                </ul>
            </li>
        @endcan
        @can('story_manager_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/success-stories*") ? "c-show" : "" }} {{ request()->is("admin/story-categories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-file-signature c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.storyManager.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('success_story_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.success-stories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/success-stories") || request()->is("admin/success-stories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-handshake c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.successStory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('story_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.story-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/story-categories") || request()->is("admin/story-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bullseye c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.storyCategory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('media_library_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.media-library.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/media-library") || request()->is("admin/media-library/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                    </i>
                        {{ trans('cruds.media_library.title') }}
                </a>
            </li>
        @endcan
        @can('service_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.services.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/services") || request()->is("admin/services/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                    </i>
                        {{ trans('cruds.service.title') }}
                </a>
            </li>
        @endcan
        @can('seenon_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.seenons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seenons") || request()->is("admin/seenons/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                    </i>
                        {{ trans('cruds.seenon.title') }}
                </a>
            </li>
        @endcan


        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('testimonial_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.testimonials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-star-half-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.testimonial.title') }}
                </a>
            </li>
        @endcan
        @can('static_seo_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.static-seos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/static-seos") || request()->is("admin/static-seos/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.staticSeo.title') }}
                </a>
            </li>
        @endcan
        @can('menu_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.menu.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu") || request()->is("admin/menu/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-bell c-sidebar-nav-icon">
                    </i>
                    {{ trans('global.menu') }}
                </a>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
            </li>
        @endcan
        @can('redirector_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ url("admin/redirectors") }}" class="c-sidebar-nav-link {{ request()->is("admin/redirectors") || request()->is("admin/redirectors/*") ? "active" : "" }}">
                    <i class="fa-fw fa fa-link c-sidebar-nav-icon">

                    </i>
                    Redirection
                </a>
            </li>
		@endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
