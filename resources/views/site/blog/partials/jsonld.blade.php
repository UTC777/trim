<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        @foreach($articles as $article)
        {
            "@type": "BlogPosting",
            "@id": "{{ route('blog.show', $article->slug) }}#article",
            "url": "{{ route('blog.show', $article->slug) }}",
            "headline": "{{ $article->title }}",
            "image": {
                "@type": "ImageObject",
                "url": "{{ $article->featured_image ? $article->featured_image->getUrl('featured') : '' }}",
                "width": 800,
                "height": 600
            },
            "datePublished": "{{ $article->created_at->toIso8601String() }}",
            "dateModified": "{{ $article->updated_at->toIso8601String() }}",
            "author": {
                "@type": "Person",
                "name": "{{ $article->author ? $article->author->name : '' }}",
                "@id": "{{ url('') }}/#/schema/person/{{ $article->author ? $article->author->uuid : '' }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Utah Trim Clinic",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ $setting->header_logo ? $setting->header_logo->getUrl() : '' }}",
                    "width": 316,
                    "height": 89
                }
            },
            "description": "{{ $article->excerpt }}"
        } @if(!$loop->last) , @endif
    @endforeach
    ]
}
</script>
