@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .form-control::placeholder {color: #d3d4d5 !important;}
</style>
@endpush

<div class="mb-1 ui-widget">
    <label for="tagsInput" class="form-label">
        Tags <small class="text-secondary">(select up to ten tags, click on tags to remove)</small>
    </label>
    <input type="text" class="form-control" id="tagsInput" placeholder="start typing...">
</div>
<div class="mb-3">
    <div id="tags" style="height:60px; overflow:auto;"></div>
</div>

@push('body_scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    const cache = {}
    const tags = {}
    const $form = $('form');
    const tagLimit = 10;

    @if (!empty($tags))
        let arr = {{ Illuminate\Support\Js::from($tags) }};
        arr.forEach((tag) => appendTag(tag));
    @endif

    $('#tagsInput').autocomplete({
        source: (request, response) => {
            let key = request.term;

            // prevent hitting database for repeated search term
            if (key in cache) {
                response(cache[key]);
            }

            // get tags from server
            // todo -> authentication
            $.get('/api/tags', {term:request.term}, (data) => {
                cache[key] = data;
                response(data);
            });
        },
        minLength: 1,
        select: (event, ui) => {
            let tag = ui.item;
            $('#tagsInput').val('');

           if (!(tag.id in tags) && Object.keys(tags).length < tagLimit) {
                appendTag(tag);
           }

           return false;
        }
    });

    // Allow for tag removal
    $form.on('click', '.badge', (event) => {
        $('#'+event.target.id).remove();
        let id = event.target.id.replace('tag-', '');
        delete tags[id];
    });

    // Prevent enter from submitting form
    $form.on('keydown', (event) => {
        if (event.keyCode === 13) {
            event.preventDefault();
        }
    });

    // Create hidden form fields based on tags for server processing
    $form.on('submit', () => {
        let arr = [];

        for (let id in tags) {
            arr.push({'id': id, 'label': tags[id]});
        }

        let json = JSON.stringify(arr);
        $form.append(`
                <input type="hidden" name="tags" value='${json}'>
            `);
    });

    function appendTag(tag) {
        $('#tags').append(
            `<span role="button"
                   class="badge rounded-pill text-bg-light m-1"
                   id="tag-${tag.id}">${tag.label}</span>`
        );

        tags[tag.id] = tag.label;
    }
</script>
@endpush
