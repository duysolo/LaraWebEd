<?php
$errors = Session::get('errorMessages');
$messages = Session::get('successMessages');
$infos = Session::get('infoMessages');
$warnings = Session::get('warningMessages');
?>
<script type="text/javascript">
    {{--Flash message for errors--}}
    @if($errors) @foreach($errors as $key => $row)
        Utility.showNotification('{{ $row }}', 'error');
    @endforeach @endif
    {{--Flash message for errors--}}

    {{--Flash message for messages--}}
    @if($messages) @foreach($messages as $key => $row)
        Utility.showNotification('{{ $row }}', 'success');
    @endforeach @endif
    {{--Flash message for messages--}}

    {{--Flash message for infors--}}
    @if($infos) @foreach($infos as $key => $row)
        Utility.showNotification('{{ $row }}', 'info');
    @endforeach @endif
    {{--Flash message for infors--}}

    {{--Flash message for warnings--}}
    @if($warnings) @foreach($warnings as $key => $row)
        Utility.showNotification('{{ $row }}', 'warning');
    @endforeach @endif
    {{--/=Flash message for warnings--}}
</script>
