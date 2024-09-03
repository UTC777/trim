@if ($article->featured_image)
    @php
        $featured_image = $article->featured_image->getUrl('featured');
    @endphp
@else
    @php
        $featured_image = '';
    @endphp
@endif

@if ($setting->header_logo)
    @php
        $logo = $setting->header_logo->getUrl();
    @endphp
@else
    @php
        $logo = '';
    @endphp
@endif

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "Article",
            "@id": "{{ route('blog.show', $article->slug) }}/#article",
            "isPartOf": {
                "@id": "{{ route('blog.show', $article->slug) }}"
            },
            "author": {
                "@type": "Person",
                "name": "{{ $article->author ? $article->author->name : '' }}",
                "@id": "{{ url('') }}/#/schema/person/{{ $article->author ? $article->author->uuid : '' }}"
            },
            "headline": "{{ $article->title ?? '' }}",
            "datePublished": "{{ $article->created_at->toIso8601String() }}",
            "dateModified": "{{ $article->updated_at->toIso8601String() }}",
            "mainEntityOfPage": {
                "@id": "{{ route('blog.show', $article->slug) }}"
            },
            "wordCount": {{ $article->word_count }},
            "commentCount": {{ $article->comments->count() }},
            "publisher": {
                "@id": "{{ url('') }}/#organization"
            },
            "image": {
                "@type": "ImageObject",
                "@id": "{{ route('blog.show', $article->slug) }}/#primaryimage",
                "url": "{{ $featured_image }}",
                "contentUrl": "{{ $featured_image }}",
                "width": 1920,
                "height": 500
            },
            "thumbnailUrl": "{{ $featured_image }}",
            "articleSection": [
                "{{ @$article->categories->first()->name }}"
            ],
            "inLanguage": "en-US",
            "potentialAction": [
                {
                    "@type": "CommentAction",
                    "name": "Comment",
                    "target": [
                        "{{ route('blog.show', $article->slug) }}/#respond"
                    ]
                }
            ]
        },
        {
            "@type": "WebPage",
            "@id": "{{ route('blog.show', $article->slug) }}",
            "url": "{{ route('blog.show', $article->slug) }}",
            "name": "{{ $article->title }} | Utah Trim Clinic",
            "isPartOf": {
                "@id": "{{ url('') }}/#website"
            },
            "primaryImageOfPage": {
                "@id": "{{ route('blog.show', $article->slug) }}/#primaryimage"
            },
            "image": {
                "@id": "{{ route('blog.show', $article->slug) }}/#primaryimage"
            },
            "thumbnailUrl": "{{ $featured_image }}",
            "datePublished": "{{ $article->created_at->toIso8601String() }}",
            "dateModified": "{{ $article->updated_at->toIso8601String() }}",
            "description": "{{ $article->staticSeo ? $article->staticSeo->meta_description : '' }}",
            "breadcrumb": {
                "@id": "{{ route('blog.show', $article->slug) }}/#breadcrumb"
            },
            "inLanguage": "en-US",
            "potentialAction": [
                {
                    "@type": "ReadAction",
                    "target": [
                        "{{ route('blog.show', $article->slug) }}"
                    ]
                }
            ]
        },
        {
            "@type": "BreadcrumbList",
            "@id": "{{ route('blog.show', $article->slug) }}/#breadcrumb",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $article->title }}"
                }
            ]
        },
        {
            "@type": "WebSite",
            "@id": "{{ url('') }}/#website",
            "url": "{{ url('') }}",
            "name": "Utah Trim Clinic",
            "description": "Semaglutide for Weight Loss",
            "publisher": {
                "@id": "{{ url('') }}/#organization"
            },
            "potentialAction": [
                {
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "{{ url('') }}/?s={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }
            ],
            "inLanguage": "en-US"
        },
        {
            "@type": "Organization",
            "@id": "{{ url('') }}/#organization",
            "name": "Utah Trim Clinic",
            "url": "{{ url('') }}",
            "logo": {
                "@type": "ImageObject",
                "inLanguage": "en-US",
                "@id": "{{ url('') }}/#/schema/logo/image/",
                "url": "{{ $logo }}",
                "contentUrl": "{{ $logo }}",
                "width": 316,
                "height": 89,
                "caption": "Utah Trim Clinic"
            },
            "image": {
                "@id": "{{ url('') }}/#/schema/logo/image/"
            }
        },
        {
            "@type": "Person",
            "@id": "{{ url('') }}/#/schema/person/{{ $article->author ? $article->author->uuid : '' }}",
            "name": "{{ $article->author ? $article->author->name : '' }}",
            "sameAs": [
                "{{ url('') }}"
            ]
        }
    ]
}
</script>
