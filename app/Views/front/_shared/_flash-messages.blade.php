<?php
$errors = Session::get('errorMessages');
$messages = Session::get('successMessages');
$infos = Session::get('infoMessages');
$warnings = Session::get('warningMessages');
?>
@if($errors || $messages || $infos || $warnings)
<div class="modal fade" tabindex="-1" role="dialog" id="flash-messages-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LaraWebEd notification</h4>
            </div>
            <div class="modal-body">
                @if($errors) <div class="alert alert-danger" role="alert"> @foreach($errors as $key => $row)
                   <p>{{ $row }}</p>
                @endforeach </div> @endif
                @if($messages) <div class="alert alert-success" role="alert"> @foreach($messages as $key => $row)
                    <p>{{ $row }}</p>
                @endforeach </div> @endif
                @if($infos) <div class="alert alert-info" role="alert"> @foreach($infos as $key => $row)
                    <p>{{ $row }}</p>
                @endforeach </div> @endif
                @if($warnings) <div class="alert alert-warning" role="alert"> @foreach($warnings as $key => $row)
                    <p>{{ $row }}</p>
                @endforeach </div> @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#flash-messages-modal').modal();
    });
</script>
@endif