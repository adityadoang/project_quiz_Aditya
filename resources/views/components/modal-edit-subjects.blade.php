<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT SUBJECTS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <div class="modal-body">                

                <div class="form-group">
                    <label class="control-label">subject</label>
                    <textarea class="form-control" id="name" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-subject"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">hours</label>
                    <textarea class="form-control" id="city" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-hours"></div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-edit-teachers', function () {

        let subjects_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/subjects/${subjects_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#subjects_id').val(response.data.id);
                $('#subject-edit').val(response.data.subject);
                $('#hours-edit').val(response.data.hours);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update post
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let teachers_id = $('#subjects_id').val();
        let name   = $('#subject-edit').val();
        let city = $('#hours-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/subjects/${subjects_id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "subject": subject,
                "hours": hours,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data post
                let subjects = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.subject}</td>
                        <td>${response.data.hours}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to post data
                $(`#index_${response.data.id}`).replaceWith(subjects);

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            error:function(error){
                
                if(error.responseJSON.id[0]) {

                    //show alert
                    $('#alert-id').removeClass('d-none');
                    $('#alert-id').addClass('d-block');

                    //add message to alert
                    $('#alert-id').html(error.responseJSON.id[0]);
                } 

                if(error.responseJSON.subject[0]) {

                    //show alert
                    $('#alert-subject').removeClass('d-none');
                    $('#alert-subject').addClass('d-block');

                    //add message to alert
                    $('#alert-subject').html(error.responseJSON.subject[0]);
                } 

                if(error.responseJSON.hours[0]) {

                    //show alert
                    $('#alert-hours').removeClass('d-none');
                    $('#alert-hours').addClass('d-block');

                    //add message to alert
                    $('#alert-hours').html(error.responseJSON.hours[0]);
                } 

                   }

        });

    });

</script>