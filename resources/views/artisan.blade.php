
<!-- Chat card -->
<div class="card card-primary">
    <div class="card-header with-border">
        <i class="icon-terminal"></i>
    </div>
    <div class="card-body chat" id="terminal-card">
        <!-- chat item -->

        <!-- /.item -->
    </div>
    <!-- /.chat -->
    <div class="card-footer with-border">

        <div style="margin-bottom: 10px;">

            @foreach($commands['groups'] as $group => $command)

            <div class="btn-group dropup">
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $group }}
                </button>
                <ul class="dropdown-menu commands-dropdown" style="max-height: 480px; overflow-y: auto;">
                    @foreach($command as $item)
                        <li><a class="dropdown-item loaded-command" href="javascript:void(0);">{{$item}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach

            <div class="btn-group dropup">
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ trans('lavero-admin-helpers::helpers.other') }}
                </button>
                <ul class="dropdown-menu commands-dropdown" style="max-height: 480px; overflow-y: auto;">
                    @foreach($commands['others'] as $item)
                    <li><a class="dropdown-item loaded-command" href="javascript:void(0);">{{$item}}</a></li>
                    @endforeach
                </ul>
            </div>

            <button type="button" class="btn btn-success" id="terminal-send"><i class="fa fa-paper-plane"></i> {{ trans('lavero-admin-helpers::helpers.send') }}</button>

            <button type="button" class="btn btn-warning" id="terminal-clear"><i class="fa fa-refresh"></i> {{ trans('lavero-admin-helpers::helpers.clear') }}</button>
        </div>

        <div class="input-group">
            <span class="input-group-text px-2">artisan</span>
            <input class="form-control input-lg" id="terminal-query" placeholder="{{ trans('lavero-admin-helpers::helpers.command') }}">
        </div>
    </div>
</div>
@include("lavero-admin-helpers::_shared")
