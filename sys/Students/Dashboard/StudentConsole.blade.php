@include('Students.Dashboard.Stats')
@include('Students.Dashboard.Tables')


@isset($Mods)
    @include('viewer.viewer', [
        'PassedData' => $Mods,
        'Title' => 'View the Description of the selected course module',
        'DescriptionTableColumn' => 'ModuleDescription',
    ])
@endisset


@include('Students.Dashboard.PostExams')
@include('Students.Dashboard.ModularExams')
@include(
    'Students.Dashboard.PracticalExams'
)
