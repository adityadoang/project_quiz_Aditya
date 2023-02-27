<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id"></div>
                </div><h5 class="modal-title" id="exampleModalLabel">add teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                
                

                <div class="form-group">
                    <label class="control-label">Name</label>
                    <textarea class="form-control" id="name" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">City</label>
                    <textarea class="form-control" id="city" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-city"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Subject</label>
                    <textarea class="form-control" id="subject" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-subject"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Place of Birth</label>
                    <textarea class="form-control" id="pob" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pob"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Date of Birth</label>
                    <input type="date" class="form-control" id="title">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-dob"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Subject_id</label>
                    <textarea class="form-control" id="subject_id" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-subject_id"></div>
                </div>
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
        let id   = $('#id').val();
        let name  = $('#name').val();
        let city  = $('#city').val();
        let subject  = $('#subject').val();
        let pob  = $('#pob').val();
        let dob  = $('#dob').val();
        let subject_id  = $('#subject_id').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/teachers`,
            type: "POST",
            cache: false,
            data: {
                "id": id,
                "name": name,
                "city": city,
                "subject": subject,
                "pob": pob,
                "dob": dob,
                "subject_id": subject_id,
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
                    <tr id="index_${response.data.id}">
                        <td>${response.data.id}</td>
                        <td>${response.data.name}</td>
                        <td>${response.data.city}</td>
                        <td>${response.data.subject}</td>
                        <td>${response.data.pob}</td>
                        <td>${response.data.dob}</td>
                        <td>${response.data.subject_id}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-teachers').prepend(teacher);
                
                //clear form
                $('#id').val('');
                $('#name').val('');
                $('#city').val('');
                $('#subject').val('');
                $('#pob').val('');
                $('#dob').val('');
                $('#subject_id').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },
            error:function(error){
                
                if(error.responseJSON.id[0]) {

                    //show alert
                    $('#alert-id').removeClass('d-none');
                    $('#alert-id').addClass('d-block');

                    //add message to alert
                    $('#alert-id').html(error.responseJSON.id[0]);
                } 

                if(error.responseJSON.name[0]) {

                    //show alert
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');

                    //add message to alert
                    $('#alert-name').html(error.responseJSON.name[0]);
                } 

                if(error.responseJSON.city[0]) {

                    //show alert
                    $('#alert-city').removeClass('d-none');
                    $('#alert-city').addClass('d-block');

                    //add message to alert
                    $('#alert-city').html(error.responseJSON.city[0]);
                }
                 if(error.responseJSON.subject[0]) {

                    //show alert
                    $('#alert-subject').removeClass('d-none');
                    $('#alert-subject').addClass('d-block');

                    //add message to alert
                    $('#alert-subject').html(error.responseJSON.subject[0]);
                } 

                if(error.responseJSON.pob[0]) {

                    //show alert
                    $('#alert-pob').removeClass('d-none');
                    $('#alert-pob').addClass('d-block');

                    //add message to alert
                    $('#alert-pob').html(error.responseJSON.pob[0]);
                } 

                if(error.responseJSON.dob[0]) {

                    //show alert
                    $('#alert-dob').removeClass('d-none');
                    $('#alert-dob').addClass('d-block');

                    //add message to alert
                    $('#alert-dob').html(error.responseJSON.dob[0]);
                } 

                if(error.responseJSON.subject_id[0]) {

                    //show alert
                    $('#alert-subject_id').removeClass('d-none');
                    $('#alert-subject_id').addClass('d-block');

                    //add message to alert
                    $('#alert-subject_id').html(error.responseJSON.subject_id[0]);
                } 
            }

        });

    });

</script>