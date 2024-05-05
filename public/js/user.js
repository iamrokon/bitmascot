$(document).ready(function(){
    $('#register').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = new FormData(document.getElementById('register'));

        // Send AJAX POST request
        $.ajax({
            type: 'POST',
            url: '/register',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if ($.trim(result) == 'ok') {
                    // Handle success response
                    window.location.href = '/';
                }else {
                    // Handle error
                    var inputError = result.err_field;
                    $.each(inputError, function(index, value) {
                        let inputField = "#"+index;
                        $(inputField).css('border-color', 'red');
                    });
                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';
                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;text-align:center;font-size: 14px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';
                        $('#err_msg').html(html);
                        $("#err_msg").show();
                        $(window).scrollTop(0);
                    }
                }
            },
        });
    });

    $('#login').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = new FormData(document.getElementById('login'));

        // Send AJAX POST request
        $.ajax({
            type: 'POST',
            url: '/login',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if ($.trim(result) == 'ok') {
                    window.location.href = '/verify-otp';
                }
                else {
                    var html = '<h4 style="color:red;text-align:center;">Email or password incorrect</h4>';
                    $('#err_msg').html(html);
                    $("#err_msg").show();
                }
            },
        });
    });


    $('#otp_verify').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = new FormData(document.getElementById('otp_verify'));

        // Send AJAX POST request
        $.ajax({
            type: 'POST',
            url: '/verify-otp',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if ($.trim(result) == 'ok') {
                    window.location.href = '/profile-view';
                }else if ($.trim(result) == 'admin') {
                    window.location.href = '/admin';
                }
                else {
                // Handle error
                }
            },
        });
    });

    $('a.change_password').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var url = $(this).attr('href');
        loadPage(url, "a.profile_page", "a.change_password");
    });

    $('a.profile_page').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var url = $(this).attr('href');
        loadPage(url, "a.change_password", "a.profile_page");
    });


    $(window).on('popstate', function() {
        // Load the content based on the current URL when the user navigates back/forward
        $.ajax({
            url: window.location.href,
            method: 'GET',
            success: function(response) {
                $('#page-content').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $('#update_password').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = new FormData(document.getElementById('update_password'));

        // Send AJAX POST request
        $.ajax({
            type: 'POST',
            url: '/password-update',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if ($.trim(result) == 'ok') {
                    // location.reload();
                    window.location.href = '/profile-view';
                }else if($.trim(result) == 'ng'){
                    var html = '<h4 style="color:red;text-align:center;">Old password is incorrect</h4>';
                    $('#err_msg').html(html);
                    $("#err_msg").show();
                }
                else {
                    var html = '<h4 style="color:red;text-align:center;">Password confirmation does not match</h4>';
                    $('#err_msg').html(html);
                    $("#err_msg").show();
                }
            },
        });
    });


    $('#logoutBtn').click(function(e) {
        e.preventDefault();

        // Send an AJAX POST request to the custom logout route
        $.ajax({
            url: '/logout',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
            },
            success: function(response) {
                // Handle successful logout
                window.location.href = '/'; // Redirect to homepage or login page
            },
            error: function(xhr, status, error) {
                // Handle logout error
                alert('Failed to logout. Please try again.');
            }
        });
    });

    $('#search_data').on('keyup', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = new FormData(document.getElementById('search'));

        // Send AJAX POST request
        $.ajax({
            type: 'POST',
            url: '/search',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                $('#user_list').html(result);
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Log any errors to console
            }
        });
    });

    $('#email').keyup(function() {
        var email = $(this).val().trim();
        if (email === '') {
            $('#availabilityMsg').text('');
            return;
        }

        $.ajax({
            url: '/check-email',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
            },
            data: { email: email },
            success: function(response) {
                if (response.available) {
                    $('#availabilityMsg').text('Email is available').css('color', 'green');
                } else {
                    $('#availabilityMsg').text('Email is already taken').css('color', 'red');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to check email availability. Please try again.');
            }
        });
    });
    $('#clear_btn').click(function() {
        // Reset form fields to empty values
        $('#update_password')[0].reset(); // Using native reset() method of the form element
    });

});

function loadPage(url, currentPage, nextPage){
    // AJAX request to load new page content
    $.ajax({
        url: url, // Route to your new-page route
        method: 'GET',
        success: function(response) {
            // Replace the content of a specific element with the new page content
            $('#page-content').html(response);
            history.pushState({}, '', url);
            $('.dropdown-toggle').dropdown(); // Reinitialize dropdowns
            $(currentPage).removeClass('active')
            $(nextPage).addClass('active')
        },
        error: function(xhr) {
            console.log(xhr.responseText); // Log any errors to console
        }
    });
}

