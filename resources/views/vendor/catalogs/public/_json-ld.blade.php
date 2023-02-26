{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $catalog->title }}",
    "description": "{{ $catalog->summary !== '' ? $catalog->summary : strip_tags($catalog->body) }}",
    "image": [
        "{{ $catalog->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $catalog->uri() }}"
    }
}
</script>
--}}
