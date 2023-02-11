<script type="text/javascript">
        // Scroll to back top button
    $(document).ready(function(){
        $(window).scroll(function(){
            if($(this).scrollTop() > 400){
                $('#go_top').fadeIn();
            }else{
                $('#go_top').fadeOut();
            }
        })
        $('#go_top').click(function(){
            $('html,body').animate({
                scrollTop: 0,
            },500)
        })
    })

    // Fetch json data with ajax
    function getdata(id) {
        if (id == '') {
            $('#student_detail').hide();
            alert("Please select student name");
        }else{
            $.ajax({
                url: 'fetch_data.php',
                type: "post",
                data: {id: id},
                success: function(result){
                    let json_data = $.parseJSON(result);
                    $('#student_detail').show();
                    $('#name').html(json_data.name);
                    $('#city').html(json_data.city);
                    $('#email').html(json_data.email);
                }
            })
        }
    }

        // Dynamically add/remove input field in php
    function Add_more(){
        var field_count= $('#field_count').val();
        field_count++;
        $('#field_count').val(field_count);
        $('#myform').append('<div id="box_loop"><input type="text" name="text_value[]" id="text_value" class="form-control"><button type="button" class="btn btn-primary" style="margin-left:335px; margin-top: -65px" onclick=remove_more("'+field_count+'")>Remove</button></div> ');
    }
    function remove_more(field_count){
        $("#box_loop").remove();
        var field_count = $('#field_count').val();
        field_count--;
        $('#field_count').val(field_count);
        // alert(field_count);
    }

        // PHP Ajax Like Dislike script
    function like_update(id){
        // alert("somethings");
        $.ajax({
            url: "update_count.php",
            type: "post",
            data: 'type=like&id='+id,
            success: function (result) {
                var cur_count= $('#like_loop_'+id).html();
                cur_count++;
                $('#like_loop_'+id).html(cur_count);
            }
        });
    }
    function dislike_update(id){
        // alert("somethings");
        $.ajax({
            url: "update_count.php",
            type: "post",
            data: 'type=dislike&id='+id,
            success: function (result) {
                var cur_count= $('#dislike_loop_'+id).html();
                cur_count++;
                $('#dislike_loop_'+id).html(cur_count);
            }
        });
    }

        // Get City, State from pincode.
    function Get_detail() {
        var pincode= $('#pincode').val();
        if(pincode==''){
            $('#Tehsil').val('');
            $('#District').val('');
            $('#State').val('');
        }else{
            // alert(pincode)
            $.ajax({
                url: 'getpincode.php',
                type: 'post',
                data: {pincode: pincode},
                success: function(data){
                    // console.log(data);
                    if (data=='no') {
                        alert('Wrong pincode');
                        $('#Tehsil').val('');
                        $('#District').val('');
                        $('#State').val('');
                    }else{
                        var getdata= $.parseJSON(data);
                        $('#Tehsil').val(getdata.Tehsil);
                        $('#District').val(getdata.District);
                        $('#State').val(getdata.State);
                    }
                }
            })
        }
    }
        // Jquery textbox autocomplete with php
    $(function(){
		$('.auto').autocomplete({
			source:'search.php',
			minLength:3
		});
	});

        // How to create secure php login script with ajax.
    function form_login(){
        let username= $('#username').val();
        let password= $('#password').val();

        let is_error = '';
        $('.error_field').html('');
        if (username=="") {
            $('#username_error').html('Username is required');
            is_error= 'yes';
        }
        if (password=="") {
            $('#password_error').html('Password is required');
            is_error= 'yes';
        }
        if (is_error=="") {
            $.ajax({
                url: "check.php",
                type: "post",
                data:{username: username, password: password},
                success: function(result){
                    if (result=='correct') {
                        $('#username').val('');
                        $('#password').val('');
                        window.location.href= 'dashboard.php';
                    }else{
                        $('#result_msg').html('Please enter correct login detail');
                        $('#username').val('');
                        $('#password').val('');
                    }
                }
            })
        }
    }
</script>
