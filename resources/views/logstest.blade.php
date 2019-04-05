<?php 
return [
    // ...

    'unavailable_audits' => 'No Article Audits available',

    'updated'            => [
        'metadata' => 'On :audit_created_at, :user_name [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'title'   => 'The Title has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'content' => 'The Content has been modified from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    // ...
];
?>

<ul>
    @forelse ($audits as $audit)
    <li>
        @lang('article.updated.metadata', $audit->getMetadata())

        @foreach ($audit->getModified() as $attribute => $modified)
        <ul>
            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified)</li>
        </ul>
        @endforeach
    </li>
    @empty
    <p>@lang('article.unavailable_audits')</p>
    @endforelse
</ul>