$(document).ready(function(){

/* ===========================================
    SEARCH FUNCTION
    =========================================== */

    $("#search-form").submit(function(event){ //Don't refresh if user hits enter
        event.preventDefault();
    });

    $("#search-input").keyup(function(){ //listen for clicks

        var searchData = $('#search-input').val();

        $.post('/search.php', {"search":searchData}, function(data){

            console.log(data);

            $('#project-feed').html('');

            var projects = JSON.parse(data);
            var projectshtml = '';

            $.each(projects, function(key, project){

                projectshtml += '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 project project-post" data-projectID="' + project.id + '">';

                    projectshtml += '<div class="project-post-wrapper white">';
                        projectshtml += '<img class="project-img" src="/assets/files/' + project.projectimg + '" alt="Preview User Post">';

                        projectshtml += '<div class="project-hover d-none">'

                            if (project.user_owns === 'true'){

                                projectshtml += '<div class="trash-edit-wrapper">';
                                    projectshtml += '<a class="trash-edit-link delete-link" data-projectID="' + project.id + '" aria-hidden="true"><i class="fas fa-trash-alt"></i></a>';

                                    projectshtml += '<br>';

                                    projectshtml += '<a class="trash-edit-link" href="/posts/edit.php?id=' + project.id + '" aria-hidden="true"><i class="fas fa-edit"></i></a>';
                                projectshtml += '</div><!-- .trash-edit-wrapper -->';

                            }

                            // TRIGGER MODAL
                            projectshtml += '<a href=".project-view-container-' + project.id + '" data-toggle="modal" data-target=".project-view-container-' + project.id + '">';
                            projectshtml += '<div class="project-overlay-link">';
                                projectshtml += '<div class="title-username-wrapper white">';
                                    projectshtml += '<h5>' + project.inspiration + '</h5>';
                                        projectshtml += '<span class="small-profilepic-wrapper" class="pr-2">';

                                            var projectImage = '/assets/files/placeholder-user2.png';

                                            if( project.profilepic ){
                                                projectImage = '/assets/files/' + project.profilepic;
                                            }

                                            projectshtml += '<img class="sm-profilepic" src="'+projectImage+'" alt="Profile Pic"> ';

                                            projectshtml += '</span>';
                                        projectshtml += '<small class="white">' + project.username + '</small>';
                                    projectshtml += '</div><!-- .title-username-wrapper -->';

                                    projectshtml += '<span class="white pr-like-counter-wrapper">';
                                        projectshtml += '<i class="fas fa-heart"></i>';
                                        projectshtml += '<span class="likes-count"> ' + project.like_count + '</span>';
                                    projectshtml += '</span><!-- .float-right -->';
                                projectshtml += '</div><!-- .project-overlay-link -->';
                            projectshtml += '</a>';

                        projectshtml += '</div><!-- .project-hover -->';
                    projectshtml += '</div><!-- .project-post-wrapper -->';


                    // MODAL
                    projectshtml += '<div class="modal fade project-view-container-' + project.id + '" tabindex="-1" role="dialog" aria-labelledby="project-view-container" aria-hidden="true">';
                        projectshtml += '<div class="modal-dialog modal-dialog-centered mx-auto" role="document">';
                            projectshtml += '<div class="modal-content">';
                                projectshtml += '<div class="modal-header">';

                                    projectshtml += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                        projectshtml += '<span aria-hidden="true">&times;</span>';
                                    projectshtml += '</button>';

                                    projectshtml += '<h3 class="yellow modal-title large-font">' + project.name + '</h3>';

                                    projectshtml += '<h4 class="white lato-font mdm-font">Inspired by: <span class="bold">' + project.inspiration + '</span></h4>';

                                projectshtml += '</div><!-- modal-header-->';

                                projectshtml += '<div class="modal-body">';
                                    projectshtml += '<div class="row">';
                                        projectshtml += '<div class="project-view-img-wrapper col-md-6">';
                                            projectshtml += '<img src="/assets/files/' + project.projectimg + '" alt="Project Picture Large">';
                                        projectshtml += '</div><!-- #project-view-img-wrapper -->';


                                        projectshtml += '<div class="col-md-6 project-view-info-wrapper">';

                                            if (project.user_owns === 'true'){

                                            projectshtml += '<div class="delete-edit-links-wrapper">';
                                                projectshtml += '<small>';
                                                    projectshtml += '<a class="delete-edit-link" href="/posts/edit.php?id=' + project.id + '" aria-hidden="true">Edit</a> /';
                                                    projectshtml += '<a class="delete-edit-link" href="/posts/delete_refresh.php?id=' + project.id + '" aria-hidden="true">Delete</a>';
                                                projectshtml += '</small>';
                                            projectshtml += '</div><!-- .delete-edit-links -->'

                                            }

                                            projectshtml += '<small class="grey">Designed by:</small><br>';

                                            projectshtml += '<div class="profilepic-username-wrapper">';
                                                projectshtml += '<span class="md-profilepic-wrapper">';
                                                    projectshtml += '<img class="md-profilepic" src="' +  projectImage +'" alt="Profile Pic">';
                                                projectshtml += '</span>';
                                                projectshtml += '<a class="orange" href="users/index.php?user_id=' + project.user_id + '">' + project.username + '</a>';
                                            projectshtml += '</div><!-- #profilepic-username-wrapper -->';

                                            projectshtml += '<p class="my-5">'+ project.about + '</p>';

                                            projectshtml += '<small>';
                                                projectshtml += '<span class="orange"><i class="fas fa-heart"></i></span>';
                                                projectshtml += '<span class="likes-count grey"> ' + project.like_count + '</span>';
                                                projectshtml += '<span class="grey">';
                                                     projectshtml += ' likes';
                                                projectshtml += '</span>';
                                            projectshtml += '</small>';

                                            var like_class = 'far';
                                            var like_text = 'Like it?';

                                            if (project.like_id){
                                                like_class = 'fas';
                                                like_text = 'Liked it!';
                                            }



                                            projectshtml += '<p class="my-5">';

                                                if (project.user_owns === 'false'){

                                                    projectshtml += 'Like it?';

                                                    projectshtml += '<a class="orange signin-like" href="/signin.php">';
                                                        projectshtml += '<i class="far fa-heart"></i>';
                                                    projectshtml += '</a>';

                                                }else{

                                                    projectshtml += '<span class="like-btn-text">' + like_text + '</span>';

                                                    projectshtml += '<span class="orange like-btn">';
                                                        projectshtml += ' <i class="' + like_class + ' like-icon fa-heart"></i>';
                                                    projectshtml += '</span>';

                                                }

                                            projectshtml += '</p>';

                                        projectshtml += '</div><!-- #project-view-info-wrapper -->';
                                    projectshtml += '</div><!-- .row -->';
                                projectshtml += '</div><!-- .modal-body -->';


                            projectshtml += '</div><!-- .modal-content -->';
                        projectshtml += '</div><!-- .modal-dialog -->';
                    projectshtml += '</div><!-- .project-view-container -->';

                projectshtml += '</div><!-- .project-post -->';

            });

            $('#project-feed').html(projectshtml);

        });

    });


/* ===========================================
    SIDE NAVBAR
    =========================================== */

    $("#sidebar").mCustomScrollbar({
             theme: "minimal"
        });

    $('#dismiss, .overlay').on('click', function () {
        // hide sidebar
        $('#sidebar').removeClass('active');
        // hide overlay
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.overlay').toggleClass('active');
    });

/* ===========================================
    REVEAL POST OVERLAY ON HOVER
    =========================================== */

    $(document).on({
        mouseenter: function(){
            $(this).find('.project-hover').removeClass('d-none').addClass('d-block');
        }, mouseleave: function (){
            $(this).find('.project-hover').removeClass('d-block').addClass('d-none');
        }
    }, '.project-post-wrapper');

/* ===========================================
    DELETE BUTTON
    =========================================== */

    $('#project-feed').on('click', '.delete-link', function(){

        var project_id = $(this).attr('data-projectID');

        $(this).closest('.project').remove();
        $.post('/posts/delete.php', {'project_id':project_id}, function(data){

            console.log(data);

        });

    });

/* ===========================================
    LIKING
    =========================================== */

    $('#project-feed').on('click', '.like-btn', function(){

        // COMPONENTS OR ELEMENTS TO BE UPDATED
        var $like_btn = $(this);
        var $like_icon = $like_btn.find('.like-icon');
        var $like_btn_text = $like_btn.closest('.project-post').find('.like-btn-text');
        var $likes_count = $like_btn.closest('.project-post').find('.likes-count');

        // VALUES THAT WE'RE COLLECTING FROM ELEMENTS
        var project_id = $like_btn.closest('.project-post').attr('data-projectID');

        $.post('/likes/add.php', {"project_id":project_id}, function(like_data){
            console.log(like_data);

            if( like_data.error === false ){ // loving worked
                if( like_data.liked == 'liked' ){

                    $like_icon.removeClass('far').addClass('fas');
                    $like_btn_text.text('Liked it!');
                    $likes_count.text(like_data.like_count);

                }else if( like_data.liked == 'unliked' ){

                    $like_icon.removeClass('fas').addClass('far');
                    $like_btn_text.text('Like it?');
                    $likes_count.text(like_data.like_count);

                }
            }
        });

    });

}); // END DOCUMENT READY

/* ===========================================
    REPLACE PROFILE IMG WITH PREVIEW
    =========================================== */

    function previewProfileFile(){

        var preview = document.getElementById('lg-profilepic');
        var file = document.getElementById('file-with-preview').files[0];

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file) {
            reader.readAsDataURL(file);
        }else{
            preview.src = "";
        }

    }


/* ===========================================
    REPLACE PROJECT IMG WITH PREVIEW
    =========================================== */

    function previewProjectFile(){

        var preview = document.getElementById('img-preview');
        var file = document.getElementById('file-with-preview').files[0];

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file) {
            reader.readAsDataURL(file);
        }else{
            preview.src = "";
        }

    }

/* ===========================================
    TEXTAREA CHARACTER COUNTER
    =========================================== */
    function countChar(val) {
        var len = val.value.length;
        if (len >= 501) {
            val.value = val.value.substring(0, 500);
        }else{
            $('#charNum').text(500 - len);
        }
    };
