$(document).ready(function () {
    setTimeout(() => {
        $('.sas_alert').hide();
    }, 3000);
    //image preview
    $('#image_input').change((event) => {
        var image = document.getElementById('image_view');
        image.src = URL.createObjectURL(event.target.files[0]);
    });
    $('.close_ajax_error').click(() => {
        $('.ajax_indicator_failed').hide();
    });

    //tab naivigation
    $('.sas-tab-item').click((e) => {
        $('.sas-tab-item').removeClass('active w3-blue');
        $(e.target).addClass('active w3-blue');
        let id = $(e.target).attr('id');
        $('.sas-tab-content').removeClass('active');
        $('.sas-tab-content#' + id).addClass('active');
    })

    //modal
    $('.sas-modal-button').click((e) => {
        $('#sas-modal').show();
    });
    $('.sas-modal-close-button').click((e) => {
        $('#sas-modal').hide();
    });

    //delete resource
    $('.delete-link').click((e) => {
        e.preventDefault();
        let url = $(e.target).attr('href');
        let rid = $(e.target).attr('rid');
        console.log(rid);
        deleteResorece(url, rid);
    });

});


//ajax api

function deleteResorece(url, rid) {
    $('.ajax_indicator').show();
    $.ajax({
        url: url,
        method: "DELETE",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: () => {
            $('#' + rid).remove();
            $('.ajax_indicator').hide();
        },
        error: (error) => {
            console.log(error);
            $('.ajax_indicator').hide();
            $('.ajax_indicator_failed').show();
        }
    });
}