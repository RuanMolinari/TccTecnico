var source,template,source_n, template_n = null;
        $(document).ready(function(){
             source = $('#unmod-script').html();
             template = Handlebars.compile(source);
             source_n = $('#set-mod-script').html();
             template_n = Handlebars.compile(source_n);
             console.log(source);
             console.log(source_n);

            $('#sidebar-tog').click(function(sidebar){
                sidebar.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

             $('#table-mods').bootgrid({
                ajax: true,
                url: "mod_select.php",
                })
             .on("loaded.rs.jquery.bootgrid", function (e){ checkMods(); });

             $('#table-add-mods').bootgrid({
                ajax: true,
                url: "add_mod_select.php",
                })
             .on("loaded.rs.jquery.bootgrid", function (a){ checkUsers(); });
                            
        });

    function checkMods(){
        $(".mods_check_box").bootstrapSwitch({
            size: 'mini', 
            onColor: 'success', 
            onText: 'Active', 
            offColor: 'danger', 
            offText: 'Unactive',
            onSwitchChange: function(event, state){
                switch_data = {
                user_id : $(this).parent().parent().parent().siblings(':first').html(),
                new_state : state
                };
                    $.ajax({ 
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : 'user_state.php', // the url where we want to POST
                    data        : switch_data, // our data object
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode      : true,
                    success: function(state_change){
                        console.log(state_change.res);
                    }
                }); 
                event.preventDefault();
            }
        });

        $('.unmod').on("click", function(){
            var mod_id = $(this).parent().siblings(':first').html(); 
            formData = {mod_id: mod_id};
            $('#unmod-result').html('');
            $('#set-mod-result').html('');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'unmod.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true,
                success: function(unmod_res){
                    var row = new Object;
                    row.color = unmod_res.color;
                    row.unmod_msg = unmod_res.result;
                    var html = template(row);
                    $('#unmod-result').append(html);
                    $("#table-mods").bootgrid("reload");       
                    $("#table-add-mods").bootgrid("reload");
                }
            });

        });
    }

    function checkUsers(){
        $(".users_check_box").bootstrapSwitch({
            size: 'mini', 
            onColor: 'success', 
            onText: 'Active', 
            offColor: 'danger', 
            offText: 'Unactive',
            onSwitchChange: function(event, state){
                switch_data = {
                user_id : $(this).parent().parent().parent().siblings(':first').html(),
                new_state : state
                };
                    $.ajax({ 
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : 'user_state.php', // the url where we want to POST
                    data        : switch_data, // our data object
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode      : true,
                    success: function(state_change){
                        console.log(state_change.res);
                    }
                }); 
                event.preventDefault();
            }
        });

         $('.set-as-mod').on("click", function(){
            var user_id = $(this).parent().siblings(':first').html(); 
            formData = {user_id: user_id};
            $('#set-mod-result').html('');
            $('#unmod-result').html('');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'set_as_mod.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true,
                success: function(mod_res){
                    var row = new Object;
                    row.color = mod_res.color;
                    row.set_mod_msg = mod_res.result;
                    var html = template_n(row);
                    $('#set-mod-result').append(html);
                    $("#table-mods").bootgrid("reload");
                    $("#table-add-mods").bootgrid("reload");
                }
            });

        });
    }


