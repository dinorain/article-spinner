<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="{{ asset('js/main.js') }}"></script>

{{-- lodash --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>

{{-- parsley --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

{{--toastr--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        newestOnTop: true,
        positionClass: "toast-bottom-center",
        showDuration: "300",
        hideDuration: "300",
        timeOut: "1200",
        extendedTimeOut: "0",
    };
</script>

{{--axios--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    const rootApi = axios.create({
        baseURL: `${window.location.protocol}//${window.location.host}/api`,
        headers: {
            post: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            put: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            delete: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        }
    });
</script>
