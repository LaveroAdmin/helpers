<style>
    h4 small{
        font-size:1rem;
    }
</style>
<div class="card card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">{{ trans('lavero-admin-helpers::helpers.scaffold') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form method="post" action="{{$action}}" class="needs-validation" autocomplete="off" id="scaffold" pjax-container>

            <div class="card-body">

                <div class="row mb-3">

                    <label for="inputTableName" class="col-sm-2 control-label">{{ trans('lavero-admin-helpers::helpers.table_name') }}</label>

                    <div class="col-sm-4">
                        <input type="text" name="table_name" class="form-control" id="inputTableName" placeholder="{{ trans('lavero-admin-helpers::helpers.table_name') }}" value="{{ old('table_name') }}" required>
                    </div>

                    <span class="invalid-feedback" id="table-name-help">
                        <i class="icon-info"></i>&nbsp; {{ trans('lavero-admin-helpers::helpers.table_name_help') }}
                    </span>

                </div>
                <div class="row mb-3">
                    <label for="inputModelName" class="col-sm-2 control-label">{{ trans('lavero-admin-helpers::helpers.model') }}</label>

                    <div class="col-sm-4">
                        <input type="text" name="model_name" class="form-control" id="inputModelName" placeholder="{{ trans('lavero-admin-helpers::helpers.model') }}" value="{{ old('model_name', "App\\Models\\") }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputControllerName" class="col-sm-2 control-label">{{ trans('lavero-admin-helpers::helpers.controller') }}</label>

                    <div class="col-sm-4">
                        <input type="text" name="controller_name" class="form-control" id="inputControllerName" placeholder="{{ trans('lavero-admin-helpers::helpers.controller') }}" value="{{ old('controller_name', "App\\Admin\\Controllers\\") }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="offset-sm-2 col-sm-10 d-flex justify-content-start">
                        <div class="pe-3 ps-1">
                            <input class="form-check-input" type="checkbox" checked value="migration" id="migration" name="create[]" />
                            <label for="migration">{{ trans('lavero-admin-helpers::helpers.create_migration') }}</label>
                        </div>
                        <div class="pe-3">
                            <input class="form-check-input" type="checkbox" checked value="model" id="model" name="create[]" />
                            <label for="model">{{ trans('lavero-admin-helpers::helpers.create_model') }}</label>
                        </div>
                        <div class="pe-3">
                            <input class="form-check-input" type="checkbox" checked value="controller" id="controller" name="create[]" />
                            <label for="controller">{{ trans('lavero-admin-helpers::helpers.create_controller') }}</label>
                        </div>
                        <div class="pe-3">
                            <input class="form-check-input" type="checkbox" checked value="migrate" id="migrate" name="create[]" />
                            <label for="migrate">{{ trans('lavero-admin-helpers::helpers.run_migration') }}</label>
                        </div>
                        <div class="pe-3">
                            <input class="form-check-input" type="checkbox" checked value="menu_item" id="menu_item" name="create[]" />
                            <label for="menu_item">{{ trans('admin.menu') }}</label>
                        </div>
                    </div>
                </div>

                <hr />

                <h4>{{ trans('lavero-admin-helpers::helpers.fields') }} <small>(id)</small></h4>

                <table class="table table-hover" id="table-fields">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 200px">{{ trans('lavero-admin-helpers::helpers.field_name') }}</th>
                            <th>{{ trans('lavero-admin-helpers::helpers.type') }}</th>
                            <th>{{ trans('lavero-admin-helpers::helpers.nullable') }}</th>
                            <th>{{ trans('lavero-admin-helpers::helpers.key') }}</th>
                            <th>{{ trans('lavero-admin-helpers::helpers.default_value') }}</th>
                            <th>{{ trans('lavero-admin-helpers::helpers.comment') }}</th>
                            <th>{{ trans('admin.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="table-fields-body">

                    @if(old('fields'))
                        @foreach(old('fields') as $index => $field)
                            <tr>
                                <td><i class="icon-arrows-alt move-handle"></i></td>
                                <td>
                                    <input type="text" name="fields[{{$index}}][name]" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.field_name') }}" value="{{$field['name']}}" />
                                </td>
                                <td>
                                    <select class="form-select" style="width: 200px" name="fields[{{$index}}][type]">
                                        @foreach($dbTypes as $type)
                                            <option value="{{ $type }}" {{$field['type'] == $type ? 'selected' : '' }}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-check-input" type="checkbox" name="fields[{{$index}}][nullable]" {{ \Illuminate\Support\Arr::get($field, 'nullable') == 'on' ? 'checked': '' }}/></td>
                                <td>
                                    <select class="form-select" style="width: 150px" name="fields[{{$index}}][key]">
                                        {{--<option value="primary">Primary</option>--}}
                                        <option value="" {{$field['key'] == '' ? 'selected' : '' }}>NULL</option>
                                        <option value="unique" {{$field['key'] == 'unique' ? 'selected' : '' }}>Unique</option>
                                        <option value="index" {{$field['key'] == 'index' ? 'selected' : '' }}>Index</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.default_value') }}" name="fields[{{$index}}][default]" value="{{$field['default']}}"/></td>
                                <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.comment') }}" name="fields[{{$index}}][comment]" value="{{$field['comment']}}" /></td>
                                <td><a class="btn btn-sm btn-danger table-field-remove"><i class="icon-trash"></i> {{ trans('lavero-admin-helpers::helpers.remove') }}</a></td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td><i class="icon-arrows-alt move-handle"></i></td>
                        <td>
                            <input type="text" name="fields[0][name]" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.field_name') }}" />
                        </td>
                        <td>
                            <select class="form-select" style="width: 200px" name="fields[0][type]">
                                @foreach($dbTypes as $type)
                                    <option value="{{ $type }}">{{$type}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="checkbox" class="form-check-input" name="fields[0][nullable]" checked /></td>
                        <td>
                            <select class="form-select" style="width: 150px" name="fields[0][key]">
                                {{--<option value="primary">Primary</option>--}}
                                <option value="" selected>NULL</option>
                                <option value="unique">Unique</option>
                                <option value="index">Index</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.default_value') }}" name="fields[0][default]"></td>
                        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.comment') }}" name="fields[0][comment]"></td>
                        <td><a class="btn btn-sm btn-danger table-field-remove"><i class="icon-trash"></i> {{ trans('lavero-admin-helpers::helpers.remove') }}</a></td>
                    </tr>
                    @endif
                    </tbody>
                </table>

                <hr style="margin-top: 0;"/>

                <div class='d-flex align-items-center'>

                    <div class='form-group flex-grow-1 '>
                        <a class="btn btn-sm btn-success" id="add-table-field"><i class="icon-plus"></i>&nbsp;&nbsp;{{ trans('lavero-admin-helpers::helpers.new_field') }}</a>

                    </div>


                    <div class='form-group ps-3'>
                        <input type="checkbox" class="form-check-input" checked id="timestamps" name="timestamps">
                        <label for="timestamps">{{ trans('lavero-admin-helpers::helpers.timestamps') }}</label>
                        &nbsp;&nbsp;
                        <input type="checkbox" class="form-check-input" id="soft-deletes" name="soft_deletes">
                        <label for="soft-deletes">{{ trans('lavero-admin-helpers::helpers.soft_deletes') }}</label>
                    </div>

                    <div class='form-group d-flex align-items-center ps-3'>
                        <label for="inputPrimaryKey pe-2">{{ trans('lavero-admin-helpers::helpers.key') }} &nbsp;</label>
                        <input type="text" name="primary_key" class="form-control" id="inputPrimaryKey" placeholder="{{ trans('lavero-admin-helpers::helpers.primary_key') }}" value="id" style="width: 100px;">
                    </div>


                </div>


            </div>
            <div class="card-footer clearfix">
                <button type="submit" class="btn btn-info float-end">{{ trans('admin.submit') }}</button>
            </div>

            {{ csrf_field() }}

        </form>
    </div>
</div>

<template id="table-field-tpl">
    <tr>
        <td><i class="icon-arrows-alt move-handle"></i></td>
        <td>
            <input type="text" name="fields[__index__][name]" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.field_name') }}" />
        </td>
        <td>
            <select class="form-select" style="width: 200px" name="fields[__index__][type]">
                @foreach($dbTypes as $type)
                    <option value="{{ $type }}">{{$type}}</option>
                @endforeach
            </select>
        </td>
        <td><input type="checkbox" class="form-check-input" name="fields[__index__][nullable]" checked /></td>
        <td>
            <select class="form-select" style="width: 150px" name="fields[__index__][key]">
                <option value="" selected>NULL</option>
                <option value="unique">Unique</option>
                <option value="index">Index</option>
            </select>
        </td>
        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.default_value') }}" name="fields[__index__][default]"></td>
        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.comment') }}" name="fields[__index__][comment]"></td>
        <td><a class="btn btn-sm btn-danger table-field-remove"><i class="icon-trash"></i> {{ trans('lavero-admin-helpers::helpers.remove') }}</a></td>
    </tr>
</template>

<template id="model-relation-tpl">

        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.relation_name') }}" value=""></td>
        <td>
            <select style="width: 150px">
                <option value="HasOne" selected>HasOne</option>
                <option value="BelongsTo">BelongsTo</option>
                <option value="HasMany">HasMany</option>
                <option value="BelongsToMany">BelongsToMany</option>
            </select>
        </td>
        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.related_model') }}"></td>
        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.default_value') }}"></td>
        <td><input type="text" class="form-control" placeholder="{{ trans('lavero-admin-helpers::helpers.default_value') }}"></td>
        <td><input type="checkcard" /></td>
        <td><a class="btn btn-sm btn-danger model-relation-remove"><i class="icon-trash"></i> {{ trans('lavero-admin-helpers::helpers.remove') }}</a></td>

</template>

<script>

(function () {

    //$('select').select2();

    var el = document.getElementById('table-fields-body');
    var sortable = Sortable.create(el,{
        handle: ".move-handle"
    });

    document.getElementById('add-table-field').addEventListener("click",function (event) {

        let template = document.getElementById('table-field-tpl').innerHTML;
        let fieldRow = (String(template)).replace(/__index__/g, String(document.querySelectorAll('#table-fields tr').length - 1));
        let newRow = document.createElement('tr');
        newRow.innerHTML = fieldRow;
        console.log(newRow);

        document.querySelector('#table-fields-body').appendChild(newRow);
        // maybe add nice select function
    });

    document.getElementById('table-fields').addEventListener("click",function(event){
        if (!event.target.closest('.table-field-remove')) return;
        event.target.closest('tr').remove();
    });

    if (document.getElementById('add-model-relation')){
        // not implemented yet :-(
        document.getElementById('add-model-relation').addEventListener("click",function (event) {
            document.getElementById('model-relations tbody').append(document.getElementById('model-relation-tpl').html().replace(/__index__/g, document.getElementById('model-relations tr').length - 1));

            relation_count++;
        });

        document.getElementById('table-fields').querySelectorAll('.model-relation-remove').forEach( elm => {
            elm.addEventListener("click", function(event) {
                event.target.closest('tr').remove();
            });
        });
    }

    document.getElementById('scaffold').addEventListener('submit', function (event) {

        event.preventDefault();

        if (document.getElementById('inputTableName').value == '') {
            document.getElementById('inputTableName').closest('.form-group').classList.add('has-error');
            document.getElementById('table-name-help').classList.remove('hide');

            return false;
        }

        return true;
    });
})();

</script>
