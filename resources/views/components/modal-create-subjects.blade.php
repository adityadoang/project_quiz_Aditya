<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="control-label">subject</label>
                    <textarea class="form-control" id="subject" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">hours</label>
                    <textarea class="form-control" id="hours" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-city"></div>
                </div>

                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let subject  = $('#subject').val();
        let hours  = $('#hours').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/subjects`,
            type: "POST",
            cache: false,
            data: {
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
                let teacher = `
                        <td>${response.data.subject}</td>
                        <td>${response.data.hours}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-teachers').prepend(teacher);
                
                //clear form
                $('#subject').val('');
                $('#hours').val('');
               

                //close modal
                $('#modal-create').modal('hide');
                

            },
            error:function(error){
                
                

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