<?php
function recruitmentPageZoomStyles()
{
    echo '<style>body { zoom: 75%; }</style>';
}

function recruitmentRenderMessage($message, $type = 'success')
{
    if ($message === '') {
        return;
    }

    $class = $type === 'error' ? 'error' : 'success';
    echo '<div class="employee-registration-message ' . $class . '">' . htmlspecialchars($message) . '</div>';
}

function recruitmentDepartments()
{
    return [
        'Human Resource',
        'Finance',
        'Operations',
        'Marketing',
        'Administration',
        'Information Technology',
    ];
}
