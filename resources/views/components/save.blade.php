<button type="button"
        id="{{ $job->id }}"
        data-method="{{ $saved ? 'DELETE' : 'POST' }}"
        class="btn {{ $saved ? 'btn-primary' : 'btn-outline-primary' }} btn-save">
    {{ $saved ? 'Unsave' : 'Save' }}
</button>

@auth
@pushonce('body_scripts')
<script>
    $(document).ready(() => {
        $('.container').on('click', '.btn-save', (event) => {
            let $btn = $('#'+event.target.id);
            $btn.attr('disabled', true)
            let method = $btn.attr('data-method');
            let data = {
                id: "{{ $job->id }}",
                title: "{{ $job->title }}",
                _method: method,
                _token: "{{ csrf_token() }}"
            };
            $.ajax({
                url: '/jobs/save',
                data: data,
                method: method,
                success: () => {
                    $btn.attr('disabled', false);
                    $btn.attr('data-method', method === 'POST' ? 'DELETE' : 'POST');
                    $btn.html(method === 'POST' ? 'Unsave' : 'Save');

                    if (method === 'POST') {
                        $btn.removeClass('btn-outline-primary')
                        $btn.addClass('btn-primary')
                    } else {
                        $btn.removeClass('btn-primary')
                        $btn.addClass('btn-outline-primary')
                    }
                },
                error: (response) => {
                    console.log(response);
                },
            });
        });
    });
</script>
@endpushonce
@endauth
