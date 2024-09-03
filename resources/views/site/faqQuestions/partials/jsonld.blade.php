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
      "@type": "WebPage",
      "@id": "{{ url('') }}/faqs/",
      "url": "{{ url('') }}/faqs/",
      "name": "{{ $staticpageseo->page_name ?? 'FAQs' }} | Utah Trim Clinic",
      "isPartOf": {
        "@id": "{{ url('') }}/#website"
      },
      "datePublished": "{{ $staticpageseo->created_at ?? '' }}",
      "dateModified": "{{ $staticpageseo->updated_at ?? '' }}",
      "description": "{{ $staticpageseo->meta_description ?? '' }}",
      "breadcrumb": {
        "@id": "{{ url('') }}/faqs/#breadcrumb"
      },
      "inLanguage": "en-US",
      "potentialAction": [
        {
          "@type": "ReadAction",
          "target": [
            "{{ url('') }}/faqs/"
          ]
        }
      ]
    },
    {
      "@type": "BreadcrumbList",
      "@id": "{{ url('') }}/faqs/#breadcrumb",
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
          "name": "Faq"
        }
      ]
    },
    {
      "@type": "WebSite",
      "@id": "{{ url('') }}/#website",
      "url": "{{ url('') }}",
      "name": "Utah Trim Clinic",
      "description": "{{ $staticpageseo->meta_description ?? '' }}",
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
      "@type": "FAQPage",
      "mainEntity": [
        @foreach($faqQuestions as $faq)
        {
          "@type": "Question",
          "name": "{{ $faq->question }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ $faq->use_html_answer == 1 ? strip_tags($faq->html_answer) : $faq->answer }}"
          }
        }@if(!$loop->last),@endif
    @endforeach
    ]
  }
]
}
</script>
