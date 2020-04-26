@extends('layouts.app')

@section('content')
<div class="container">
    @if ($accounts->count() === 0)
    <p>{{ __('No accounts registered.') }}</p>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Account name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Management') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->name }}</td>
                <td>{{ $account->created_at->format(__('Y/m/d')) }}</td>
                <td>
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-remove" data-href="{{ route('remove', [$account->id]) }}">{{ __('Delete') }}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="text-right">
        <a href="{{ route('home') }}" class="btn btn-light">{{ __('Cancel') }}</a>
    </div>
</div>
<div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-labelledby="modal-remove-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-remove-label">{{ __('Are you sure?') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('You are removing:') }} <strong id="account-name"></strong></p>
                <p>{!! __('Once removed you won\'t be able to recover this access token. This may result in <strong>ENTIRELY LOST ACCESS</strong> to you account.') !!}</p>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="agreement">
                    <label class="form-check-label" for="agreement">{{ __('I understand and wish to proceed.') }}</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="delete-confirm" disabled>{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let url = false
        $('#modal-remove').on('show.bs.modal', function (event) {
            url = event.relatedTarget.dataset.href;
            $('#account-name').text($(event.relatedTarget.parentElement).siblings().map((index, el) => el.textContent).get().join(' - '))
        }).on('hidden.bs.modal', () => {
            url = false
            $('#agreement').prop('checked', false).trigger('change')
        });
        $('#agreement').on('change', function () {
            $('#delete-confirm').prop('disabled', !this.checked);
        });
        $('#delete-confirm').on('click', () => {
            url && axios.post(url, { _method: 'DELETE' }).then(response => {
                location = '{{ route("home") }}'
            })
        })
    })
</script>
@endpush