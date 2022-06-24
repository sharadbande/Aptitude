$(document).ready(function(){

$('#addcategory').on('submit', function (evt) {
    evt.preventDefault();
    var data=$('#addcategory').serialize();
    console.log(data);
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'category_post',
        data: data,
        dataType : 'json',
        success: function(response) {
            if(response.status=="200")
           {

            swal.fire("Done!", response.message, "success");
            $('#Category').modal('toggle');
            location.reload();
           }

        }

    });
});

});

// user click then form rest and set hidden value to ADD
        function resetform(){
            $("#addcategory")[0].reset();
            $("#FromAction").val("Add");
        }

// Click On Edit button
        function editproject(id){
            $.ajax({
             method:'GET',
             url:'/GetCategoryid',
             data:{'id':id},
             dataType:'json',
             success:function(categoryID_info)
             {

                $("#category_name").val(categoryID_info.category_name);
                $("#cat_id").val(categoryID_info.id);

// add hidden feild to Edit
                $("#FromAction").val("Edit");
                $('#Category').modal('show');
             },
            error: function(e){
                alert(error)
            }
          });
        }


        function del(id){

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:'post',
                    url: '/deleteCat',
                    data:{'id':id},
                    dataType:'json',

                    success: function(response) {
                        if(response.status=="200")
                       {
                          swal.fire("Done!", response.message, "success");

                        location.reload();
                       }

                    }

                });


        }
