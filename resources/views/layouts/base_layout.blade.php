<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>মিস্ত্রী</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->


    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="../../../assets/vendors/core/core.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">

    <!-- endinject -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <style>
        .choices__inner {
            background-color: #0C1427 !important;
        }

        .choices__list {
            color: #E43F31;
            background-color: #0C1427 !important;
        }
    </style>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">


    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
</head>

<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <!-- <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script> -->
    <!-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        $(document).ready(function () {
            Dropzone.autoDiscover = false; // Prevent auto-discovery

            var myDropzone = new Dropzone("#file-dropzone", {
                url: '{{ route('service.create') }}',
                maxFilesize: 2, // MB
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                autoProcessQueue: false, // Prevent auto upload
                addRemoveLinks: true,
                init: function () {
                    var dropzoneInstance = this;

                    document.querySelector("#my-dropzone").addEventListener("submit", function (e) {
                        e.preventDefault();

                        // Manually add form data (email and password) to Dropzone files
                        dropzoneInstance.on("sending", function (file, xhr, formData) {
                            formData.append("email", document.querySelector("#email").value);
                            formData.append("password", document.querySelector("#password").value);
                        });

                        // Process the Dropzone queue
                        dropzoneInstance.processQueue();
                    });

                    // Success handling
                    dropzoneInstance.on("success", function (file, response) {
                        console.log("File uploaded successfully", response);
                    });

                    // Error handling
                    dropzoneInstance.on("error", function (file, response) {
                        console.log("Error uploading file", response);
                    });
                }
            });

            $('.delete-category').on('click', function (event) {
                event.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('category.delete', ':id') }}";
                let del_url = url.replace(':id', id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: del_url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (reponse) {
                                $('#category-' + id).remove();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            },
                            error: function (response) {
                                alert(response);
                            }
                        })
                    }
                });
            })
            $('.busy').on('click', function () {
                $('.date_div').css('display', 'block')
            })

            $('.free').on('click', function () {
                $('.date_div').css('display', 'none')
            })

            // new Choices('#selected_district', {
            //     removeItemButton: true,
            //     placeholderValue: 'Example placeholder',
            //     searchEnabled: false
            // });

            var thanaSelect = new Choices('#example-multiselect', {
                removeItemButton: true,
                placeholderValue: 'Example placeholder',
                searchPlaceholderValue: null,
                placeholder: '',
                searchEnabled: false
            });

            $('#selected_district').change(function () {
                let district_id = $(this).val();
                let url = "{{ route('get-thana', ':id') }}";
                let thana_url = url.replace(':id', district_id);
                let arry = [];
                $.ajax({
                    url: thana_url,
                    type: "GET",
                    success: function (data) {
                        // thanaSelect.clearStore();
                        let choicesArray = data.map(thana => ({
                            value: thana.id,
                            label: thana.thananamebn
                        }));
                        thanaSelect.setChoices(choicesArray, 'value', 'label', true);
                    },
                    error: function () {
                        console.error('Failed to fetch thanas.');
                    }
                })
            })
        })
    </script>
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Custom js for this page -->

    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <!-- core:js -->
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->


    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->


    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->
</body>

</html>