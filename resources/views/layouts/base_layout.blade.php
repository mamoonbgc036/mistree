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
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">

    <!-- endinject -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .choices__inner {
            background-color: #0C1427 !important;
        }

        .choices__list {
            color: #E43F31;
            background-color: #0C1427 !important;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-item {
            margin-right: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .preview-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .remove-image {
            display: block;
            color: red;
            cursor: pointer;
            margin-top: 5px;
        }

        .upload-container {
            position: relative;
            width: 100%;
            border: 2px dashed #ccc;
            border-radius: 8px;
            background-color: #0C1427;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-label {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            cursor: pointer;
            text-align: center;
        }

        /* .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        } */

        /* .preview-image {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
        } */
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
</head>

<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        $(document).ready(function () {
            let selectedFiles = new DataTransfer();

            $('#file-input').on('change', function (event) {
                const files = event.target.files;

                // Loop through the selected files
                for (let i = 0; i < files.length; i++) {
                    const fileIndex = selectedFiles.items.length; // Get the current length of selectedFiles

                    // Add the file to the DataTransfer object
                    selectedFiles.items.add(files[i]);

                    // Create a new FileReader to read and display the image
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Create an image element with the file's data
                        const img = $('<img>').attr('src', e.target.result).addClass('preview-image');
                        // Create a remove link
                        const removeLink = $('<span>').text('Remove Image').addClass('remove-image').data('index', fileIndex);

                        // Append the image and remove link to the preview container
                        const previewDiv = $('<div>').addClass('preview-item').append(img).append(removeLink);
                        $('#previews').append(previewDiv);
                    };
                    reader.readAsDataURL(files[i]); // Read the image as a Data URL
                }

                // Update the file input's files property with the newly added files
                this.files = selectedFiles.files;
            });

            // Event delegation for dynamically added "Remove Image" links
            $('#previews').on('click', '.remove-image', function () {
                const fileIndex = $(this).data('index'); // Get the file index to remove
                $(this).parent().remove(); // Remove the preview div

                // Remove the file from the DataTransfer object
                selectedFiles.items.remove(fileIndex);

                // Update the file input's files property
                $('#file-input')[0].files = selectedFiles.files;
            });
        });
        $(document).ready(function () {
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