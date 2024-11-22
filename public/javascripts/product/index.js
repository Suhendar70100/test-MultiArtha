const product = $('.dataTable')
const productUrl = `${BASE_URL}/api/product`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'name',
            name: 'name'
        },
        {
            id: 'price',
            name: 'price'
        },
        {
            id: 'description',
            name: 'description'
        },
        {
            id: 'poster',
            name: 'poster'
        }
    ]
}


const getInitData = () => {
    product.DataTable({
        processing: true,
        serverSide: true,
        ajax: productUrl,
        columns: [
            {data: 'name', name: 'name'},
            {
                data: 'price',
                name: 'price',
                render: function(data, type, row) {
                    return 'Rp. ' + parseFloat(data).toLocaleString('id-ID', { minimumFractionDigits: 0 });
                }
            },
            {
                data: 'description', 
                name: 'description',
                render: function(data, type, full, meta) {
                    return data.length > 20 ? data.substr(0, 20) + '...' : data;
                }
            },
            {
                data: 'poster', 
                name: 'poster',
                render: function(data, type, full, meta) {
                    return `<img src="${data}" alt="Image" style="width: 100px; height: auto;" />`;
                },
                orderable: false, 
                searchable: false  
            },         
            {
                data: 'aksi',
                name: 'aksi',
            }
        ]
    });
}


$(function () {
    getInitData()
})

const resetForm = () => formConfig.fields.forEach(({id}) => $(`#${id}`).val(''))

$(function () {
    addButton.on('click', function () {
        modalTitle.text('Tambah Produk')
        submitButton.text('Tambah')
        resetForm()
        $('#addProductButton').modal('show');
    })

    $('#addProductButton').on('hidden.bs.modal', function () {
        resetForm();
        $(this).find('.invalid-feedback').text('');
    });
})

submitButton.on('click', function () {
    const id = $('#id').val()
    $(this).text().toLowerCase() === "ubah" ? update(id) : store()
})

const store = () => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: productUrl,
        method: 'POST',
        dataType: 'json',
        data: dataFormStore(),
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addProductButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(product);
        },
        error: ({responseJSON}) => {
            handleError(responseJSON);
        }
    });
}

const update = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: `${productUrl}/${id}`,
        method: 'POST',
        dataType: 'json',
        data: dataFormEdit(id),
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addProductButton').modal('hide');
            resetForm()
            toastr.success(res.message, 'Success')
            reloadDatatable(product)
        },
        error: ({responseJSON}) => {
            handleError(responseJSON)
        }
    })
}

const dataFormStore = () => {
    const formData = new FormData();
    const name = $('#name').val();
    const price = $('#price').val();
    const description = $('#description').val();

    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);

    const fileInput = $('#poster')[0].files[0];
    if (fileInput) {
        formData.append('poster', fileInput);
    }

    return formData;
} 

const dataFormEdit = id => {
    const formData = new FormData();
    const name = $('#name').val();
    const price = $('#price').val();
    const description = $('#description').val();

    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);

    const fileInput = $('#poster')[0].files[0];
    if (fileInput) {
        formData.append('poster', fileInput);
    }

    formData.append('_method', 'PUT');
    return formData;
}


const reloadDatatable = table => table.DataTable().ajax.reload(null, false);

const handleError = (responseJSON) => {
    const { errors } = responseJSON;
    formConfig.fields.forEach(({ id, name }) => {
        if (errors.hasOwnProperty(id)) {
            $(`#${id}`).addClass("is-invalid");
            $(`#${id}`).next('.invalid-feedback').text(errors[id][0]);
        } else {
            $(`#${id}`).removeClass('is-invalid').next('.invalid-feedback').text('');
        }
    });
}

$(document).on('click', '.btn-edit', function () {
    const productId = $(this).data('id')
    $.ajax({
        url: `${productUrl}/${productId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id)
            submitButton.text('Ubah')
            modalTitle.text('Ubah Produk')
            formConfig.fields.forEach(({ id }) => {
                const field = $(`#${id}`);
                if (field.attr('type') === 'file') return;
                field.val(res?.[id]);
            });
            $('#addProductButton').modal('show');
        },
        error: err => {
            console.log(err)
        }
    })
})

$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Anda Yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        customClass: {
            confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
            cancelButton: 'btn btn-label-secondary waves-effect'
        },
        buttonsStyling: false
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: `${productUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(product);
                },
                error: err => {
                        toastr.error('Gagal menghapus data. Silahkan coba lagi.', 'Error');
                }
            });
        }
    });
});